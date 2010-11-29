<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Jochen Rau 
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

require_once(t3lib_extMgm::extPath('semantic') . 'Resources/Private/Libraries/Arc2/ARC2.php');

/**
 * SparqlQuery
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_SparqlQuery extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * name
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;
	
	/**
	 * queryString
	 * @var string
	 * @validate NotEmpty
	 */
	protected $queryString;
	
	/**
	 * endpoint
	 * @var Tx_Semantic_Domain_Model_SparqlEndpoint
	 */
	protected $endpoint;
	
	/**
	 * namespaces
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_Namespace>
	 */
	protected $namespaces;
	/**
	 * The constructor. Initializes all Tx_Extbase_Persistence_ObjectStorage instances.
	 */
	public function __construct() {
		$this->namespaces = new Tx_Extbase_Persistence_ObjectStorage();
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
	 * Setter for queryString
	 *
	 * @param string $queryString queryString
	 * @return void
	 */
	public function setQueryString($queryString) {
		$this->queryString = $queryString;
	}

	/**
	 * Getter for queryString
	 *
	 * @return string queryString
	 */
	public function getQueryString() {
		return $this->queryString;
	}
	
	/**
	 * Setter for endpoint
	 *
	 * @param Tx_Semantic_Domain_Model_SparqlEndpoint $endpoint endpoint
	 * @return void
	 */
	public function setEndpoint(Tx_Semantic_Domain_Model_SparqlEndpoint $endpoint) {
		$this->endpoint = $endpoint;
	}

	/**
	 * Getter for endpoint
	 *
	 * @return Tx_Semantic_Domain_Model_SparqlEndpoint endpoint
	 */
	public function getEndpoint() {
		return $this->endpoint;
	}
	
	/**
	 * Setter for namespaces
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_Namespace> $namespaces namespaces
	 * @return void
	 */
	public function setNamespaces(Tx_Extbase_Persistence_ObjectStorage $namespaces) {
		$this->namespaces = $namespaces;
	}

	/**
	 * Getter for namespaces
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_Namespace> namespaces
	 */
	public function getNamespaces() {
		return $this->namespaces;
	}
	
	/**
	 * Adds a Namespace
	 *
	 * @param Tx_Semantic_Domain_Model_Namespace the Namespace to be added
	 * @return void
	 */
	public function addNamespace(Tx_Semantic_Domain_Model_Namespace $namespace) {
		$this->namespaces->attach($namespace);
	}
	
	/**
	 * Removes a Namespace
	 *
	 * @param Tx_Semantic_Domain_Model_Namespace the Namespace to be removed
	 * @return void
	 */
	public function removeNamespace(Tx_Semantic_Domain_Model_Namespace $namespace) {
		$this->namespaces->detach($namespace);
	}

	public function execute() {
		$statement = '';
		foreach ($this->getNamespaces() as $namespace) {
			$statement .= 'PREFIX ' . $namespace->getPrefix() . ': <' . $namespace->getUri() . '>';
		}
		$statement .= $this->getQueryString();

		$remoteStore = ARC2::getRemoteStore(array('remote_store_endpoint' => $this->getEndpoint()->getUri()));
		return $remoteStore->query($statement, 'rows');
	}
}
?>