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
 * A SPARQL endpoint
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_Sparql_Endpoint extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * The name of the endpoint.
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;
	
	/**
	 * iri
	 * @var Tx_Semantic_Domain_Model_Rdf_Iri
	 */
	protected $iri;
	
	/**
	 * Setter for name
	 *
	 * @param string $name The name of the endpoint.
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for name
	 *
	 * @return string The name of the endpoint.
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Setter for iri
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Iri $iri iri
	 * @return void
	 */
	public function setIri(Tx_Semantic_Domain_Model_Rdf_Iri $iri) {
		$this->iri = $iri;
	}

	/**
	 * Getter for iri
	 *
	 * @return Tx_Semantic_Domain_Model_Rdf_Iri iri
	 */
	public function getIri() {
		return $this->iri;
	}
	
}
?>