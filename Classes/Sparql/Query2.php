<?php
declare(ENCODING = 'utf-8') ;
namespace T3\Semantic\Sparql;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Maroschik <tmaroschik@dfau.de>
 *  All rights reserved
 *
 *  This class is a port of the corresponding class of the
 *  {@link http://aksw.org/Projects/Erfurt Erfurt} project.
 *  All credits go to the Erfurt team.
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * Erfurt Sparql Query2
 *
 * represents a sparql query
 *
 * @package Semantic
 * @scope prototype
 */
function typeHelper($obj) {
	$class = get_class($obj);
	return !empty($class) ? $class : gettype($obj);
}
class Query2 extends Query2\ContainerHelper {
	/**
	 * @staticvar string a constant for select type
	 */
	const typeSelect = 'SELECT';
	/**
	 * @staticvar string a constant for ask type
	 */
	const typeAsk = 'ASK';
	/**
	 * @staticvar string a constant for construct type
	 */
	const typeConstruct = 'CONSTRUCT';
	/**
	 * @staticvar string a constant for describe type
	 */
	const typeDescribe = 'DESCRIBE';

	protected $type = null;
	protected $limit = 0;
	protected $offset = 0;
	protected $distinctReducedMode = 0;
	protected $order = null;
	protected $projectionVars = array();
	protected $star = true;
	protected $countStar = false;
	protected $where = null;
	protected $prefixes = array();
	protected $froms = array();
	protected $base = null;
	protected $constructTemplate = null;

	/**
	 * @staticvar int id
	 */
	protected static $idCounter = 0;
	protected $idCounterSerialized;

	/**
	 * getNextID
	 * generate a runtime-unique id for Query2 related objects
	 * @return	 int	id
	 */
	static function getNextID() {
		return self::$idCounter++;
	}

	public function __construct($type = null) {
		parent::__construct();
		$this->order = new Query2\OrderClause();
		$this->where = new Query2\GroupGraphPattern;
		if ($type !== null) {
			$this->setQueryType($type);
		} else {
			$this->setQueryType(self::typeSelect);
		}
	}

	public function __clone() {
		foreach ($this as $key => $val) {
			if (is_object($val) || (is_array($val))) {
				$this->{$key} = unserialize(serialize($val));
				//$this->$key= clone($this->$key);
			}
		}
	}

	public function __toString() {
		return $this->getSparql();
	}

	/**
	 * redirect method calls to the query object
	 * @param string $name
	 * @param array $params
	 */
	public function __call($name, $params) {
		if (method_exists($this->where, $name)) {
			$ret = call_user_func_array(array($this->where, $name), $params);
		} else {
			throw new \RuntimeException("Query2: method $name does not exists");
		}
		if ($this->where->equals($ret)) {
			return $this;
		}
		else
		{
			return $ret;
		}
	}

	public function  __sleep() {
		$this->idCounterSerialized = isset(self::$idCounter) ? self::$idCounter : rand(10000, getrandmax());
		return array_diff(array_keys(get_object_vars($this)), array('idCounter')); //save all but the static var
	}

	public function   __wakeup() {
		self::$idCounter = $this->idCounterSerialized; //restore the static var
	}

	/**
	 * getSparql
	 * build a query string
	 * @return	string	query
	 */
	public function getSparql() {
		$sparql = '';
		if ($this->hasBase()) {
			$sparql .= 'BASE ' . $this->base->getSparql() . " \n";
		}
		foreach ($this->prefixes as $prefix)
			$sparql .= $prefix->getSparql() . " \n";
		$sparql .= $this->type . ' ';
		if ($this->type == self::typeSelect) {
			switch ($this->distinctReducedMode) {
				case 0:
					break;
				case 1:
					$sparql .= 'DISTINCT ';
					break;
				case 2:
					$sparql .= 'REDUCED ';
					break;
			}
		}
		if ($this->type == self::typeSelect || $this->type == self::typeDescribe) {
			if (!$this->countStar) {
				if (count($this->projectionVars) != 0 && !$this->star) {
					foreach ($this->projectionVars as $selectVar) {
						$sparql .= $selectVar->getSparql() . ' ';
					}
				} else {
					$sparql .= '*';
				}
			} else {
				$sparql .= 'COUNT(*)';
			}
		}
		$sparql .= " \n";
		if ($this->type == self::typeConstruct) {
			$sparql .= $this->constructTemplate->getSparql();
		}
		foreach ($this->froms as $from) {
			$sparql .= 'FROM ' . $from->getSparql() . " \n";
		}
		if ($this->type != self::typeDescribe) {
			$sparql .= 'WHERE ' . $this->where->getSparql();
		}
		if ($this->type != self::typeAsk) {
			if ($this->hasOrderBy()) {
				$sparql .= $this->order->getSparql() . " \n";
			}
			if ($this->hasLimit()) {
				$sparql .= 'LIMIT ' . $this->limit . " \n";
			}
			if ($this->hasOffset()) {
				$sparql .= 'OFFSET ' . $this->offset . " \n";
			}
		}
		return $sparql;
	}

	/**
	 * setQueryType
	 * set type of the query (select, ask, describe or construct)
	 * @param string $type one of the constants Erfurt_Sparql_Query2::typeSelect,...
	 * @return	Erfurt_Sparql_Query2	$this
	 */
	public function setQueryType($type) {
		//special configs for different types...
		switch ($type) {
			case self::typeSelect:
				break;
			case self::typeAsk:
				//ask has no solution modifyer - delete?
				//$this->setLimit(0);
				//$this->setOffset(0);
				//$this->order = new Query2\OrderClause();
				//$this->distinctReducedMode = 0;
				//$this->projectionVars = array();
				break;
			case self::typeDescribe:
				break;
			case self::typeConstruct:
				$this->constructTemplate = new Query2\ConstructTemplate();
				break;
			default:
				throw new \RuntimeException('Erfurt_Sparql_Query2::setQueryType :' .
										   ' Unknown query type given: "' . $type . '"');
		}
		//save type
		$this->type = $type;
		return $this; //for chaining
	}

	/**
	 * isConstructType
	 * @return bool true if the query is a construct query
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * hasOffset
	 * @return bool true if the query a offset modifier
	 */
	public function hasOffset() {
		return $this->offset != 0;
	}

	/**
	 * hasLimit
	 * @return bool true if the query is a limit modifier
	 */
	public function hasLimit() {
		return $this->limit != 0;
	}

	/**
	 * isSelectType
	 * @return bool true if the query is a select query
	 */
	public function hasOrderBy() {
		return $this->order->used();
	}

	/**
	 * setWhere
	 * set a GroupGraphPattern as the where part of the query
	 * @param Query2\GroupGraphPattern $npattern
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function setWhere(Query2\GroupGraphPattern $npattern) {
		//TODO maybe add check here that the pattern doesnt contain
		//two variables with same name
		$this->where = $npattern;
		return $this; //for chaining
	}

	/**
	 * getWhere
	 * get the where part of the query
	 * @return Query2\GroupGraphPattern pattern
	 */
	public function getWhere() {
		return $this->where;
	}

	/**
	 * setConstructTemplate
	 * set a ConstructTemplate in the query
	 * (only usefull if the query is a construct query)
	 * @param Query2\ConstructTemplate $npattern
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function setConstructTemplate(Query2\ConstructTemplate $npattern) {
		//TODO maybe add check here that the pattern
		//doesnt contain two variables with same name
		$this->constructTemplate = $npattern;
		return $this; //for chaining
	}

	/**
	 * getConstructTemplate
	 * get the ConstructTemplate of the query
	 * @return Query2\ConstructTemplate pattern
	 */
	public function getConstructTemplate() {
		return $this->constructTemplate;
	}

	/**
	 * setLimit
	 * set the solution modifier "limit"
	 * @param int $nlimit
	 */
	public function setLimit($nlimit) {
		//if ($this->type == self::typeAsk)
		//throw new \RuntimeException("Trying to set solution modifier \"Limit\" ".
		//" in an ASK-Query - not possible");
		$this->limit = $nlimit;
		return $this; //for chaining
	}

	/**
	 * removeLimit
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function removeLimit() {
		$this->limit = 0;
		return $this; //for chaining
	}

	/**
	 * getLimit
	 * @return int the limit of the query
	 */
	public function getLimit() {
		return $this->limit;
	}

	/**
	 * setOffset
	 * set the solution modifier "offset"
	 * @param int $noffset
	 */
	public function setOffset($noffset) {
		//if ($this->type == self::typeAsk)
		//    throw new \RuntimeException("Trying to set solution modifier \"Offset\"".
		//      " in an ASK-Query - not possible");
		$this->offset = $noffset;
		return $this; //for chaining
	}

	/**
	 * removeOffset
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function removeOffset() {
		$this->offset = 0;
		return $this; //for chaining
	}

	/**
	 * getOffset
	 * @return int the offset of the query
	 */
	public function getOffset() {
		return $this->offset;
	}

	/**
	 * setStar
	 * set a query to "star-mode" (when the query is of the form SELECT * FROM ...)
	 * @param bool $bool true to turn on, false to turn off star-mode
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function setStar($bool = true) {
		// delete projection vars if set to star mode - usefull?
		if ($bool === true) {
			$this->projectionVars = array();
		}
		$this->star = $bool;
		return $this; //for chaining
	}

	/**
	 * isStar
	 * @return bool true if if star-mode (when the query is of the form SELECT * FROM ...)
	 */
	public function isStar() {
		return (count($this->projectionVars) == 0 || $this->star);
	}

	/**
	 * setCountStar
	 * set a query to count-star-mode (qhen the query is of the form SELECT count(*) FROM...)
	 * @param bool $bool true to turn on, false to turn off count-star-mode
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function setCountStar($bool = true) {
		// delete projection vars if set to star mode - usefull?
		if ($bool === true) {
			$this->projectionVars = array();
		}
		$this->countStar = $bool;
		return $this; //for chaining
	}

	/**
	 * isCountStar
	 * @return bool true if count-star-mode (when the query is of the form SELECT count(*) FROM ...)
	 */
	public function isCountStar() {
		return $this->countStar;
	}

	/**
	 * setDistinct
	 * enable/disable distinct solution modifier
	 * @param bool $bool true to turn on, false to turn off
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function setDistinct($bool = true) {
		if ($bool === true) {
			$this->distinctReducedMode = 1;
		}
		else {
			if ($this->distinctReducedMode == 1) {
				$this->distinctReducedMode = 0;
			}
		}
		return $this; //for chaining
	}

	/**
	 * isDistinct
	 * @return bool true if query is set distinct, false otherwise
	 */
	public function isDistinct() {
		return $this->distinctReducedMode == 1;
	}

	/**
	 * setReduced
	 * enable/disable reduced solution modifier
	 * @param bool $bool true to turn on, false to turn off star-mode
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function setReduced($bool = true) {
		if ($bool === true) {
			$this->distinctReducedMode = 2;
		}
		else {
			if ($this->distinctReducedMode == 2) {
				$this->distinctReducedMode = 0;
			}
		}
		return $this; //for chaining
	}

	/**
	 * isReduced
	 * @return bool true if query is set reduced false otherwise
	 */
	public function isReduced() {
		return $this->distinctReducedMode == 2;
	}

	/**
	 * setBase
	 * @param Query2\IriRef $base
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function setBase(Query2\IriRef $base) {
		if ($base->isPrefixed()) {
			throw new \RuntimeException('Trying to add base with a prefix');
		}
		if ($this->base !== null) {
			$this->base->removeParent($this);
		}
		$this->base = $base;
		$base->addParent($this);
		return $this; //for chaining
	}

	/**
	 * removeBase
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function removeBase() {
		$this->base->removeParent($this);
		$this->base = null;
		return $this; //for chaining
	}

	/**
	 * getBase
	 * @return Query2\IriRef base
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * hasBase
	 * @return bool true if the query has a base set
	 */
	public function hasBase() {
		return $this->base != null;
	}

	/**
	 * addFrom
	 * @param Query2\GraphClause|Query2\IriRef|string $from
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function addFrom($from, $named = false) {
		if (!(
				$from instanceof Query2\GraphClause
				|| $from instanceof Query2\IriRef
				|| is_string($from)
		)
		) {
			throw new \RuntimeException('Argument 1 passed to ' .
									   'Erfurt_Sparql_Query2::addFrom must be an instance of ' .
									   'Query2\GraphClause or Query2\IriRef' .
									   ' or string, instance of ' . typeHelper($from) . ' given');
		}
		$named = false;
		if ($from instanceof Query2\IriRef) {
			$from = new Query2\GraphClause($from);
		}
		if (is_string($from)) {
			$from = new Query2\GraphClause(
				new Query2\IriRef($from)
			);
		}
		if (!is_bool($named)) {
			throw new \RuntimeException('Argument 2 passed to ' .
									   'Erfurt_Sparql_Query2::addFrom must be an instance of bool, ' .
									   'instance of ' . typeHelper($named) . ' given');
		} else {
			$from->setNamed($named);
		}
		//search for equal froms
		foreach ($this->froms as $compare) {
			if ($compare->getGraphIri()->getIri() == $from->getGraphIri()->getIri()
				&& $compare->isNamed() == $from->isNamed()) {
				return $this; //for chaining
			}
		}
		$this->froms[] = $from;
		return $this; //for chaining
	}

	/**
	 * getFrom
	 * @param int $i
	 * @return Query2\GraphClause the from with index i
	 */
	public function getFrom($i) {
		return $this->froms[$i];
	}

	/**
	 * getFroms
	 * @return array all froms - array of Query2\GraphClause
	 */
	public function getFroms() {
		return $this->froms;
	}

	/**
	 * removeFroms
	 * delete all Froms of this query
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function removeFroms() {
		$this->froms = array();
		return $this; //for chaining
	}

	/**
	 * removeFrom
	 * @param int $needle
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function removeFrom($needle) {
		if (!is_int($needle)) {
			throw new \RuntimeException('Argument 1 passed to ' .
									   'Erfurt_Sparql_Query2::removeFrom must be an instance of int, ' .
									   'instance of ' . typeHelper($needle) . ' given');
		}
		$new = array();
		foreach ($this->froms as $key => $from) {
			if ($from->equals($needle) && $key !== $needle) {
				$new[] = $from;
			}
		}
		$this->froms = $new;
		return $this; //for chaining
	}

	/**
	 * setFroms
	 * @param array an array of Query2\GraphClause
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function setFroms($froms) {
		if (!is_array($froms)) {
			$tmp = $froms;
			$froms = array();
			$froms[0] = $tmp;
		}
		foreach ($froms as $key => $from) {
			if ($froms[$key] instanceof Query2\IriRef) {
				$froms[$key] = new Query2\GraphClause($froms[$key]);
			}
			if (is_string($froms[$key])) {
				$froms[$key] = new Query2\GraphClause(
					new Query2\IriRef($froms[$key])
				);
			}
		}
		$this->froms = $froms;
		return $this; //for chaining
	}

	/**
	 * setFrom
	 * @param int i index of the from to overwrite
	 * @param Query2\GraphClause from the new from object
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function setFrom($i, Query2\GraphClause $from) {
		if (!is_int($i)) {
			throw new \RuntimeException('Argument 1 passed to ' .
									   'Erfurt_Sparql_Query2::setFrom must be an instance of int, ' .
									   'instance of ' . typeHelper($i) . ' given');
		}
		$this->froms[$i] = $from;
		return $this; //for chaining
	}

	/**
	 * hasFroms
	 * @return bool true if there are froms in this query
	 */
	public function hasFroms() {
		return !empty($this->froms);
	}

	/**
	 * hasFrom
	 * @param Query2\GraphClause|Query2\IriRef|string $from
	 * @return bool true if the given from is present in this query
	 */
	public function hasFrom($from) {
		if (!(
				$from instanceof Query2\GraphClause
				|| $from instanceof Query2\IriRef
				|| is_string($from)
		)
		) {
			throw new \RuntimeException('Argument 1 passed to ' .
									   'Erfurt_Sparql_Query2::hasFrom must be an instance of ' .
									   'Query2\GraphClause or Query2\IriRef ' .
									   'or string, instance of ' . typeHelper($from) . ' given');
		}
		if ($from instanceof Query2\IriRef) {
			$from = new Query2\GraphClause($from);
		}
		if (is_string($from)) {
			$from = new Query2\GraphClause(
				new Query2\IriRef($from)
			);
		}
		return in_array($from, $this->froms);
	}

	/**
	 * addProjectionVar
	 * add a variable to the projection modifier (i.e. SELECT ?s FROM...)
	 * @param Query2\Variable $var
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function addProjectionVar(Query2\Variable $var) {
		foreach ($this->projectionVars as $myVar) {
			if ($myVar->equals($var)) {
				//already added
				return $this;
			}
		}
		/*if (!in_array($var, $this->where->getVars())) {
					trigger_error('Trying to add projection-var ('.$var->getSparql().') '.
				 * 'that is not used in pattern', E_USER_NOTICE);
					return $this; //for chaining
				}*/
		if (count($this->projectionVars) == 0) {
			//if the first var is added: deactivate the star.
			//maybe always?
			$this->star = false;
		}
		$this->projectionVars[] = $var;
		return $this; //for chaining
	}

	/**
	 * removeProjectionVar
	 * @param Query2\Variable $var
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function removeProjectionVar(Query2\Variable $var) {
		$new = array();
		//hack to detect multiple var objects with the same "name" -
		//should be prevented by the factory method for vars
		foreach ($this->projectionVars as $compare) {
			if (!$compare->equals($var)) {
				$new[] = $compare;
			}
		}
		$this->projectionVars = $new;
		return $this; //for chaining
	}

	/**
	 * removeAllProjectionVars
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function removeAllProjectionVars() {
		$this->projectionVars = array();
		return $this;
	}

	/**
	 * addPrefix
	 * @param Query2\Prefix $prefix
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function addPrefix(Query2\Prefix $prefix) {
		$this->prefixes[] = $prefix;
		return $this; //for chaining
	}

	/**
	 * removePrefix
	 * @param Query2\Prefix $var
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function removePrefix($needle) {
		$new = array();
		foreach ($this->prefixes as $key => $compare) {
			if (!$compare->equals($needle) && $key !== $needle) {
				$new[] = $compare;
			}
		}
		$this->prefixes = $new;
		return $this; //for chaining
	}

	/**
	 * getPrefixes
	 * @return array array of prefixes
	 */
	public function getPrefixes() {
		return $this->prefixes;
	}

	/**
	 * getPrefix
	 * @param $needle int
	 * @return Query2\Prefix
	 */
	public function getPrefix($needle) {
		return $this->prefixes[$needle];
	}

	/**
	 * getPrefixes
	 * @return Erfurt_Sparql_Query2
	 */
	public function removePrefixes() {
		$this->prefixes = array();
		return $this;
	}

	public function hasPrefix() {
		return count($this->prefixes) > 0;
	}

	/**
	 * getProjectionVars
	 * @return array array of Query2\Variable - all projection vars
	 */
	public function getProjectionVars() {
		return $this->projectionVars;
	}

	public function hasProjectionVars() {
		return count($this->projectionVars) > 0;
	}

	/**
	 * getVars
	 * @return array array of Query2\Variable - all vars used in the where pattern
	 */
	public function getVars() {
		return $this->where->getVars();
	}

	/**
	 * getOrder
	 * @return Query2\OrderClause the order clause
	 */
	public function getOrder() {
		//if ($this->type == self::typeAsk) {
		//  throw new \RuntimeException(
		//      "Trying to set solution modifier \"Order\" in an ASK-Query - not possible"
		//  );
		//}
		return $this->order;
	}

	/**
	 * getVar
	 * a factory method that either instantiates a var with the given name
	 * or if a var with that name is already used in this query gives you that one
	 * @param string $name
	 * @return Query2\Variable the var
	 */
	public function getVar($name) {
		$used = $this->where->getVars();
		$countUsed = count($used);
		for ($i = 0; $i < $countUsed; ++$i) {
			if ($name == $used[$i]->getName()) {
				return $used[$i];
			}
		}
		return new Query2\Variable($name);
	}

	/**
	 * optimize
	 * calls the optimize command on the where pattern and/or constructTemplate
	 * @return Erfurt_Sparql_Query2 $this
	 */
	public function optimize() {
		if ($this->where != null) {
			$this->where->optimize();
		}
		if ($this->constructTemplate != null) {
			$this->constructTemplate->optimize();
		}
		return $this;
	}

	public function getParentContainer($needle) {
		$parents = array();
		if (in_array($needle, array_merge($this->prefixes, $this->froms, $this->projectionVars))) {
			$parents[] = $this;
		}
		$parents = array_merge($parents, $this->where->getParentContainer($needle));
		return $parents;
	}

	public function removeElement($element, $equal = false) {
		if ($element instanceof Query2\Variable) {
			$this->removeProjectionVar($element);
		} else {
			if ($element instanceof Query2\GraphClause) {
				$this->removeFrom($element);
			} else {
				if ($element instanceof Query2\Prefix) {
					$this->removePrefix($element);
				} else {
					if ($element instanceof Query2\IriRef) {
						$this->removeBase($element);
					} else {
						//throw
						return $this;
					}
				}
			}
		}
		$element->removeParent($this);
		return $this;
	}

	public function setElements($elements) {
		//throw
	}

	public static function initFromString($queryString, $parsePartial = null) {
		// $parser = new Erfurt_Sparql_Parser_Sparql10();
		// $fromParser = $parser->initFromString($queryString, array());
		// if($fromParser['retval'] instanceof Erfurt_Sparql_Query2){
		//     return $fromParser['retval'];
		// } else {
		//     throw new Exception("Error in parser: ". print_r($fromParser['errors'], true));
		//     return null;
		// }
		$q;
		$parser = new Parser\Sparql10();
		try {
			$q = $parser->initFromString($queryString, $parsePartial);
			if ($q['errors']) {
				$e = new Exception('Parse Error: ' . implode(',', $q['errors']));
				throw $e;
			}
			// var_dump($q);
			return $q['retval'];
		}
		catch (\Exception $e) {
			// if ($querySpec['type'] === 'positive') {
			//     $this->fail($this->_createErrorMsg($querySpec, $e));
			// }
			return $e;
		}
	}

}

?>