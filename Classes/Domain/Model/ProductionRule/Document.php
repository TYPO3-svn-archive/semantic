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
 * The Document is the root element of any RIF-PRD instance document
 * The Document contains:
 * 	zero or more directive sub-elements
 * 	zero or one payload sub-element
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * @tutorial http://www.w3.org/TR/2010/PR-rif-prd-20100511/
 * @xml Root(Document)
 */
class Tx_Semantic_Domain_Model_ProductionRule_Document extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * Zero or more directive sub-elements, each containing an Import directive	
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Import>
	 * @xml Element(Tx_Semantic_Domain_Model_ProductionRule_Import, Import)
	 */
	protected $directives;
	
	/**
	 * Zero or one payload sub-element, that must contain a Group element	
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Group
	 */
	protected $payload;
	
	/**
	 * Sets directives
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Import> $directives
	 */
	public function setDirectives(Tx_Extbase_Persistence_ObjectStorage $directives) {
		$this->directives = $directives;
	}
	
	/**
	 * Adds a directive
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Import directive
	 */
	public function addDirective(Tx_Semantic_Domain_Model_ProductionRule_Import $directive) {
		$this->directives->attach($directive);
	}
	
	/**
	 * Removes a directive
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Import $directive
	 */
	public function remove(Tx_Semantic_Domain_Model_ProductionRule_Import $directive) {
		$this->directives->detach($directive);
	}
	
	/**
	 * Returns directives
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage An object storage containing directives
	 */
	public function getDirectives() {
		return $this->directives;
	}
	
	/**
	 * Sets $payload
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Group $payload
	 */
	public function setPayload(Tx_Semantic_Domain_Model_ProductionRule_Group $payload) {
		$this->payload = $payload;
	}
	
	/**
	 * Returns $payload
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Group
	 */
	public function getPayload() {
		return $this->payload;
	}
	
}
?>