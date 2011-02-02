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
 * Sparql_Query
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_Sparql_Query extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_Sparql_QueryInterface {
	
	/**
	 * @var Tx_Extbase_Object_ObjectManagerInterface
	 */
	protected $objectManager;

	/**
	 * name
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;
	
	/**
	 * query
	 * @var string
	 */
	protected $query;
	
	/**
	 * endpoint
	 * @var Tx_Semantic_Domain_Model_Sparql_Endpoint
	 */
	protected $endpoint;
	
	/**
	 * namespaces
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_Rdf_Namespace>
	 */
	protected $namespaces;
	
	/**
	 * @param Tx_Extbase_Object_ObjectManagerInterface $objectManager
	 * @return void
	 */
	public function injectObjectManager(Tx_Extbase_Object_ObjectManagerInterface $objectManager) {
		$this->namespaces = new Tx_Extbase_Persistence_ObjectStorage();
		$this->objectManager = $objectManager;
	}

	/**
	 * Setter for name
	 *
	 * @param string $name name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for name
	 *
	 * @return string name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Setter for query
	 *
	 * @param string $query query
	 * @return void
	 */
	public function setQuery($query) {
		$this->query = $query;
	}

	/**
	 * Getter for query
	 *
	 * @return string query
	 */
	public function getQuery() {
		return $this->query;
	}
	
	/**
	 * Setter for endpoint
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint endpoint
	 * @return void
	 */
	public function setEndpoint(Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint) {
		$this->endpoint = $endpoint;
	}

	/**
	 * Getter for endpoint
	 *
	 * @return Tx_Semantic_Domain_Model_Sparql_Endpoint endpoint
	 */
	public function getEndpoint() {
		return $this->endpoint;
	}
	
	/**
	 * Setter for namespaces
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_Rdf_Namespace> $namespaces namespaces
	 * @return void
	 */
	public function setNamespaces(Tx_Extbase_Persistence_ObjectStorage $namespaces) {
		$this->namespaces = $namespaces;
	}

	/**
	 * Getter for namespaces
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_Rdf_Namespace> namespaces
	 */
	public function getNamespaces() {
		return $this->namespaces;
	}
	
	/**
	 * Adds a Rdf_Namespace
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Namespace the Rdf_Namespace to be added
	 * @return void
	 */
	public function addNamespace(Tx_Semantic_Domain_Model_Rdf_Namespace $namespace) {
		$this->namespaces->attach($namespace);
	}
	
	/**
	 * Removes a Rdf_Namespace
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Namespace the Rdf_Namespace to be removed
	 * @return void
	 */
	public function removeNamespace(Tx_Semantic_Domain_Model_Rdf_Namespace $namespace) {
		$this->namespaces->detach($namespace);
	}
	
	/**
	 * Executes the query against the SPARQL Endpoint and returns the result
	 *
	 * @return Tx_Semantic_Domain_Model_Sparql_QueryResultInterface The query result object 
	 * @api
	 */
	public function execute() {
		return new Tx_Semantic_Domain_Model_Sparql_QueryResult($this);
	}

}
?>