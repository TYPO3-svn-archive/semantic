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
class Tx_Semantic_Domain_Model_Sparql_QueryResult implements Tx_Extbase_Persistence_QueryResultInterface {

	/**
	 * Names of the bound variable names
	 * @var array
	 * @transient
	 */
	protected $variables = array();

	/**
	 * @var array
	 * @transient
	 */
	protected $results = array();

	/**
	 * @var Tx_Semantic_Domain_Model_Sparql_QueryInterface
	 */
	protected $query;

	/**
	 * @var Tx_Semantic_Domain_Model_Sparql_QueryResultParserInterface
	 */
	protected $queryResultParser;

	/**
	 * @var Tx_Semantic_Domain_Model_Sparql_QueryResultCacheInterface
	 */
	protected $queryResultCache;

	/**
	 * @var bool
	 */
	protected $isInitialized = FALSE;

	/**
	 * Constructor
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_QueryInterface $query
	 */
	public function __construct(Tx_Semantic_Domain_Model_Sparql_QueryInterface $query) {
		$this->query = $query;
		$objectManager = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager');
		$this->queryResultParser = $objectManager->create('Tx_Semantic_Domain_Model_Sparql_QueryResultParser');
		$this->queryResultCache = $objectManager->create('Tx_Semantic_Domain_Model_Sparql_QueryResultCache');
	}

	/**
	 * Injects the Query Result Parser
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_QueryResultParserInterface $queryResultParser
	 * @return void
	 */
	//public function injectQueryResultParser(Tx_Semantic_Domain_Model_Sparql_QueryResultParserInterface $queryResultParser) {
		//$this->queryResultParser = $queryResultParser;
	//}

	/**
	 * Loads the QueryResult
	 *
	 * @return void
	 */
	protected function initialize() {
		if ($this->isInitialized === FALSE) {
			$this->results = array();
			$statement = '';
			foreach ($this->query->getNamespaces() as $namespace) {
				$statement .= 'PREFIX ' . $namespace->getPrefix() . ': <' . $namespace->getIri() . '>';
			}
			$statement .= $this->query->getQuery();
			if($this->query->getLimit() > 0) {
				$statement .= 'LIMIT ' . $this->query->getLimit();
			}
			if($this->query->getOffset() > 0) {
				$statement .= 'OFFSET ' . $this->query->getOffset();
			}
			if ($this->queryResultCache->hasResultsFor($this->query) === TRUE) {
				$parsedResponse = $this->queryResultCache->getResultsFor($this->query);
			} else {
				$status = array();
				$response = t3lib_div::getURL($this->query->getEndpoint()->getIri() . '?query=' . urlencode($statement), 0, FALSE, $status);
				if ($status['error'] === 0) {
					$parsedResponse = $this->queryResultParser->parse($response);
					$this->queryResultCache->setFor($this->query, $parsedResponse);
				} else {
					throw new Tx_Semantic_Domain_Model_Sparql_Exception_SparqlEndpointException('An Error #' . (int)$status['error'] .  'occurred. Message: ' . htmlspecialchars($status['message'] . '.'), 1295062323);
				}
			}
			$this->setVariables($parsedResponse['variables']);
			$this->setResults($parsedResponse['results']);
			$this->isInitialized = TRUE;
		}
	}

	/**
	 * Setter for variable names
	 *
	 * @param array $variables Set variable names
	 * @return void
	 */
	protected function setVariables(array $variables) {
		$this->variables = $variables;
	}

	/**
	 * Adds a variable name
	 *
	 * @param string $boundVariableName A variable name
	 * @return void
	 */
	protected function addVariable($variable) {
		$this->variables[] = (string) $variable;
	}

	/**
	 * Getter for variables
	 *
	 * @return array variables
	 * @api
	 */
	public function getVariables() {
		$this->initialize();
		return $this->variables;
	}

	/**
	 * Setter for results
	 *
	 * @param string $results results
	 * @return void
	 */
	protected function setResults($results) {
		$this->results = $results;
	}

	/**
	 * Getter for results
	 *
	 * @return string results
	 * @api
	 */
	public function getResults() {
		return $this->results;
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
		if (is_array($this->results) && count($this->results) > 0) {
			$results = $this->results;
			reset($results);
		} else {
			// TODO This has side effects if the query gets executed twice in the request/response cycle.
			$this->query->setLimit(1);
			$this->initialize();
			$results = $this->results;
		}
		$firstResult = current($results);
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
		if (is_array($this->results)) {
			return count($this->results);
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
		return isset($this->results[$offset]);
	}

	/**
	 * @param mixed $offset
	 * @return mixed
	 * @see ArrayAccess::offsetGet()
	 */
	public function offsetGet($offset) {
		$this->initialize();
		return isset($this->results[$offset]) ? $this->results[$offset] : NULL;
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
		$this->results[$offset] = $value;
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
		unset($this->results[$offset]);
	}

	/**
	 * @return mixed
	 * @see Iterator::current()
	 */
	public function current() {
		$this->initialize();
		return current($this->results);
	}

	/**
	 * @return mixed
	 * @see Iterator::key()
	 */
	public function key() {
		$this->initialize();
		return key($this->results);
	}

	/**
	 * @return void
	 * @see Iterator::next()
	 */
	public function next() {
		$this->initialize();
		next($this->results);
	}

	/**
	 * @return void
	 * @see Iterator::rewind()
	 */
	public function rewind() {
		$this->initialize();
		reset($this->results);
	}

	/**
	 * @return void
	 * @see Iterator::valid()
	 */
	public function valid() {
		$this->initialize();
		return current($this->results) !== FALSE;
	}

}
?>