<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Jochen Rau <jochen.rau@typoplanet.de>, typoplanet
 *  			
 *  All rights reserved
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
 * Sparql_QueryResult
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_Sparql_QueryResult extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_Sparql_QueryResultInterface {
	
	/**
	 * boundVariableNames
	 * @var array
	 */
	protected $boundVariableNames = array();
	
	/**
	 * @var Tx_Semantic_Domain_Model_Sparql_QueryResultMapperInterface
	 */
	protected $dataMapper;

	/**
	 * @var Tx_Semantic_Domain_Model_Sparql_QueryInterface
	 */
	protected $query;

	/**
	 * @var array
	 * @transient
	 */
	protected $queryResult;

	/**
	 * Constructor
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_QueryInterface $query
	 */
	public function __construct(Tx_Semantic_Domain_Model_Sparql_QueryInterface $query) {
		$this->query = $query;
	}

	/**
	 * Injects the DataMapper to map records to objects
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_QueryResultMapperInterface $dataMapper
	 * @return void
	 */
	public function injectDataMapper(Tx_Semantic_Domain_Model_Sparql_QueryResultMapperInterface $dataMapper) {
		$this->dataMapper = $dataMapper;
	}

	/**
	 * Loads the QueryResult
	 *
	 * @return void
	 */
	protected function initialize() {
		if (!is_array($this->queryResult)) {
			$this->queryResult = array();
			$statement = '';
			foreach ($this->query->getNamespaces() as $namespace) {
				$statement .= 'PREFIX ' . $namespace->getPrefix() . ': <' . $namespace->getIri() . '>';
			}
			$statement .= $this->query->getQuery();
			//debug($statement);

			$status = array();
			$response = t3lib_div::getURL($this->query->getEndpoint()->getIri() . '?query=' . urlencode($statement), 0, FALSE, $status);
			if ($status['error'] === 0) {
				$responseObject = new SimpleXMLElement($response);
				foreach ($responseObject->head->variable as $variable) {
					$this->addBoundVariableName((string) $variable['name']);
				}
				foreach ($responseObject->results->result as $result) {
					$bindings = array();
					foreach ($result->binding as $boundVariableValue) {
						$bindings[(string) $boundVariableValue['name']]= $this->convertBoundVariableValue($boundVariableValue);
					}
					$this->queryResult[]= $bindings;
				}
			}
			//debug($this->queryResult);
		}
	}

	/**
	 * Converts the given variable value to the corresponding RDF object
	 *
	 * @return 
	 **/
	public function convertBoundVariableValue($boundVariableValue) {
		$type = key($boundVariableValue->children());
		$value = current($boundVariableValue->children());

		switch ($type) {
			case 'literal':
				$value = new Tx_Semantic_Domain_Model_Rdf_Literal($value); 
				break;
			case 'bnode':
				$value = new Tx_Semantic_Domain_Model_Rdf_BlankNode($value);
				break;
			case 'uri':
				$value = new Tx_Semantic_Domain_Model_Rdf_Iri($value);
				break;
			default:
				throw new Tx_Semantic_Exception("The variable type of a SPARQL result doesn't match any RDF element type.'", 1292470296);
				break;
		}

		return $value;
	}

	/**
	 * Setter for boundVariableNames
	 *
	 * @param array $boundVariableNames boundVariableNames
	 * @return void
	 */
	public function setBoundVariableNames(array $boundVariableNames) {
		$this->boundVariableNames = $boundVariableNames;
	}

	/**
	 * Adds a boundVariableName
	 *
	 * @param string $boundVariableName boundVariableName
	 * @return void
	 */
	public function addBoundVariableName($boundVariableName) {
		$this->boundVariableNames[] = (string) $boundVariableName;
	}
	
	/**
	 * Getter for boundVariableNames
	 *
	 * @return array boundVariableNames
	 */
	public function getBoundVariableNames() {
		$this->initialize();
		return $this->boundVariableNames;
	}
	
	/**
	 * Setter for queryResult
	 *
	 * @param string $queryResult queryResult
	 * @return void
	 */
	public function setQueryResult($queryResult) {
		$this->queryResult = $queryResult;
	}

	/**
	 * Getter for queryResult
	 *
	 * @return string queryResult
	 */
	public function getQueryResult() {
		return $this->queryResult;
	}
	
	/**
	 * Returns a clone of the query object
	 *
	 * @return Tx_Semantic_Domain_Model_Sparql_QueryInterface
	 * @api
	 */
	public function getQuery() {
		return clone $this->query;
	}

	/**
	 * Returns the first object in the result set
	 *
	 * @return object
	 * @api
	 */
	public function getFirst() {
		if (is_array($this->queryResult)) {
			$queryResult = $this->queryResult;
			reset($queryResult);
		}
		$firstResult = current($queryResult);
		if ($firstResult === FALSE) {
			$firstResult = NULL;
		}
		return $firstResult;
	}

	/**
	 * Returns the number of objects in the result
	 *
	 * @return integer The number of matching objects
	 * @api
	 */
	public function count() {
		if (is_array($this->queryResult)) {
			return count($this->queryResult);
		}
	}

	/**
	 * Returns an array with the objects in the result set
	 *
	 * @return array
	 * @api
	 */
	public function toArray() {
		$this->initialize();
		return iterator_to_array($this);
	}

	/**
	 * This method is needed to implement the ArrayAccess interface,
	 * but it isn't very useful as the offset has to be an integer
	 *
	 * @param mixed $offset
	 * @return boolean
	 * @see ArrayAccess::offsetExists()
	 */
	public function offsetExists($offset) {
		$this->initialize();
		return isset($this->queryResult[$offset]);
	}

	/**
	 * @param mixed $offset
	 * @return mixed
	 * @see ArrayAccess::offsetGet()
	 */
	public function offsetGet($offset) {
		$this->initialize();
		return isset($this->queryResult[$offset]) ? $this->queryResult[$offset] : NULL;
	}

	/**
	 * This method has no effect on the persisted objects but only on the result set
	 *
	 * @param mixed $offset
	 * @param mixed $value
	 * @return void
	 * @see ArrayAccess::offsetSet()
	 */
	public function offsetSet($offset, $value) {
		$this->initialize();
		$this->queryResult[$offset] = $value;
	}

	/**
	 * This method has no effect on the persisted objects but only on the result set
	 *
	 * @param mixed $offset
	 * @return void
	 * @see ArrayAccess::offsetUnset()
	 */
	public function offsetUnset($offset) {
		$this->initialize();
		unset($this->queryResult[$offset]);
	}

	/**
	 * @return mixed
	 * @see Iterator::current()
	 */
	public function current() {
		$this->initialize();
		return current($this->queryResult);
	}

	/**
	 * @return mixed
	 * @see Iterator::key()
	 */
	public function key() {
		$this->initialize();
		return key($this->queryResult);
	}

	/**
	 * @return void
	 * @see Iterator::next()
	 */
	public function next() {
		$this->initialize();
		next($this->queryResult);
	}

	/**
	 * @return void
	 * @see Iterator::rewind()
	 */
	public function rewind() {
		$this->initialize();
		reset($this->queryResult);
	}

	/**
	 * @return void
	 * @see Iterator::valid()
	 */
	public function valid() {
		$this->initialize();
		return current($this->queryResult) !== FALSE;
	}

}
?>