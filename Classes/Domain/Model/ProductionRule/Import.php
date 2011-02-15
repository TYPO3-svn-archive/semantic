<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Maroschik <tmaroschik@dfau.de>
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
 * The Import directive is used to serialize the reference to an RDF graph or an OWL ontology to be combined with a RIF document.
 * The Import directive is inherited from [RIF-Core]. Its abstract syntax and its semantics are specified in [RIF-RDF-OWL].
 * The Import directive contains:
 * 	exactly one location sub-element
 * 	zero or one profile sub-element
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Import extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * Exactly one location sub-element, that contains an IRI, that serializes the location of the RDF or OWL document to be combined with the RIF document
	 * 
	 * @var Tx_Semantic_Domain_Model_Rdf_Iri
	 */
	protected $location;
	
	/**
	 * Zero or one profile sub-element, that contains an IRI. The admitted values for that constant and their semantics are listed in the section Profiles of Imports, in [RIF-RDF-OWL].
	 * 
	 * @var Tx_Semantic_Domain_Model_Rdf_Iri
	 */
	protected $profile;
	
	/**
	 * Sets $location
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Iri $location
	 */
	public function setLocation($location) {
		$this->location = $location;
	}
	
	/**
	 * Returns $location
	 *
	 * @return Tx_Semantic_Domain_Model_Rdf_Iri
	 */
	public function getLocation() {
		return $this->location;
	}
	
}
?>