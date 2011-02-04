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
 * Sparql_QueryInterface
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
interface Tx_Semantic_Domain_Model_Sparql_QueryInterface {

	/**
	 * Returns a sha1 hash to identify the the Query. The hash is being built over the properties that affects the result
	 * of the Query execution; namely the query, endpoint and namespaces property.
	 *
	 * @return void
	 */
	public function getHash();

	/**
	 * Setter for name
	 *
	 * @param string $name name
	 * @return void
	 * @api
	 */
	public function setName($name);

	/**
	 * Getter for name
	 *
	 * @return string name
	 * @api
	 */
	public function getName();

	/**
	 * Setter for query
	 *
	 * @param string $query query
	 * @return void
	 * @api
	 */
	public function setQuery($query);

	/**
	 * Getter for query
	 *
	 * @return string query
	 * @api
	 */
	public function getQuery();

	/**
	 * Sets the maximum size of the result set to limit. Returns $this to allow
	 * for chaining (fluid interface)
	 *
	 * @param integer $limit
	 * @return Tx_Semantic_Domain_Model_Sparql_QueryInterface
	 * @api
	 */
	public function setLimit($limit);

	/**
	 * Returns the maximum size of the result set.
	 *
	 * @return int The limit
	 * @api
	 */
	public function getLimit();

	/**
	 * Sets the start offset of the result set to offset. Returns $this to
	 * allow for chaining (fluid interface)
	 *
	 * @param integer $offset
	 * @return Tx_Semantic_Domain_Model_Sparql_QueryInterface
	 * @api
	 */
	public function setOffset($offset);

	/**
	 * Returns the start offset of the result set.
	 *
	 * @return int The offset
	 * @api
	 */
	public function getOffset();

	/**
	 * Setter for endpoint
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint endpoint
	 * @return void
	 * @api
	 */
	public function setEndpoint(Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint);

	/**
	 * Getter for endpoint
	 *
	 * @return Tx_Semantic_Domain_Model_Sparql_Endpoint endpoint
	 * @api
	 */
	public function getEndpoint();

	/**
	 * Setter for namespaces
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_Rdf_Namespace> $namespaces namespaces
	 * @return void
	 * @api
	 */
	public function setNamespaces(Tx_Extbase_Persistence_ObjectStorage $namespaces);

	/**
	 * Getter for namespaces
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_Rdf_Namespace> namespaces
	 * @api
	 */
	public function getNamespaces();

	/**
	 * Adds a Rdf_Namespace
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Namespace the Rdf_Namespace to be added
	 * @return void
	 * @api
	 */
	public function addNamespace(Tx_Semantic_Domain_Model_Rdf_Namespace $namespace);

	/**
	 * Removes a Rdf_Namespace
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Namespace the Rdf_Namespace to be removed
	 * @return void
	 * @api
	 */
	public function removeNamespace(Tx_Semantic_Domain_Model_Rdf_Namespace $namespace)	;

	/**
	 * Executes the query against the SPARQL Endpoint and returns the result
	 *
	 * @return Tx_Semantic_Domain_Model_Sparql_QueryResultInterface The query result object
	 * @api
	 */
	public function execute();
	
}
?>