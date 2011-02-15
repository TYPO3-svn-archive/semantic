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
 * ProductionRule_Group
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Group extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_IriMetaInterface, Tx_Semantic_Domain_Model_ProductionRule_RuleInterface {
	
	/**
	 * Contains conflictResolution (anyURI)
	 * 
	 * @var Tx_Semantic_Domain_Model_Rdf_Iri
	 */
	protected $conflictResolution;
	
	/**
	 * Contains priority
	 * 
	 * @var int
	 */
	protected $priority;
	
	/**
	 * Contains sentences
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_RuleInterface>
	 */
	protected $sentences;
	
	/**
	 * Sets $conflictResolution
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Iri $conflictResolution
	 */
	public function setConflictResolution(Tx_Semantic_Domain_Model_Rdf_Iri $conflictResolution) {
		$this->conflictResolution = $conflictResolution;
	}
	
	/**
	 * Returns $conflictResolution
	 *
	 * @return Tx_Semantic_Domain_Model_Rdf_Iri
	 */
	public function getConflictResolution() {
		return $this->conflictResolution;
	}
	
	/**
	 * Sets $priority
	 *
	 * @param int $priority
	 */
	public function setPriority($priority) {
		$this->priority = $priority;
	}
	
	/**
	 * Returns $priority
	 *
	 * @return int
	 */
	public function getPriority() {
		return $this->priority;
	}
	
	/**
	 * Sets sentences
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_RuleInterface> $sentences
	 */
	public function setSentences(Tx_Extbase_Persistence_ObjectStorage $sentences) {
		$this->sentences = $sentences;
	}
	
	/**
	 * Adds a sentence
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_RuleInterface sentence
	 */
	public function addSentence(Tx_Semantic_Domain_Model_ProductionRule_RuleInterface $sentence) {
		$this->sentences->attach($sentence);
	}
	
	/**
	 * Removes a sentence
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_RuleInterface $sentence
	 */
	public function remove(Tx_Semantic_Domain_Model_ProductionRule_RuleInterface $sentence) {
		$this->sentences->detach($sentence);
	}
	
	/**
	 * Returns sentences
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage An object storage containing sentences
	 */
	public function getSentences() {
		return $this->sentences;
	}
	
}
?>