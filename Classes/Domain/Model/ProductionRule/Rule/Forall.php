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
 * The Forall construct is used, in RIF-PRD, to represent rules with bound variables.
 * The Forall element contains:
 * 	one or more declare sub-elements
 * 	zero or more pattern sub-elements
 * 	exactly one formula sub-element
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Rule_Forall extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_IriMetaInterface, Tx_Semantic_Domain_Model_ProductionRule_RuleInterface {
	
	/**
	 * One or more declare sub-elements, each containing one Var element that represents one of the declared rule variables
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var>
	 */
	protected $declares;
	
	/**
	 * Zero or more pattern sub-elements, each containing one element from the FORMULA group of constructs, that serializes one pattern
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface>
	 */
	protected $patterns;
	
	/**
	 * Exactly one formula sub-element that serializes the formula in the scope of the variables binding, and that contains an element of the RULE group.	
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_RuleInterface
	 */
	protected $formula;
	
	/**
	 * Sets declares
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var> $declares
	 */
	public function setDeclares(Tx_Extbase_Persistence_ObjectStorage $declares) {
		$this->declares = $declares;
	}
	
	/**
	 * Adds a declare
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var declare
	 */
	public function addDeclare(Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var $declare) {
		$this->declares->attach($declare);
	}
	
	/**
	 * Removes a declare
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var $declare
	 */
	public function remove(Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var $declare) {
		$this->declares->detach($declare);
	}
	
	/**
	 * Returns declares
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage An object storage containing declares
	 */
	public function getDeclares() {
		return $this->declares;
	}
	
	/**
	 * Sets patterns
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface> $patterns
	 */
	public function setPatterns(Tx_Extbase_Persistence_ObjectStorage $patterns) {
		$this->patterns = $patterns;
	}
	
	/**
	 * Adds a pattern
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface pattern
	 */
	public function addPattern(Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface $pattern) {
		$this->patterns->attach($pattern);
	}
	
	/**
	 * Removes a pattern
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface $pattern
	 */
	public function remove(Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface $pattern) {
		$this->patterns->detach($pattern);
	}
	
	/**
	 * Returns patterns
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage An object storage containing patterns
	 */
	public function getPatterns() {
		return $this->patterns;
	}
	
	/**
	 * Sets $formula
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_RuleInterface $formula
	 */
	public function setFormula(Tx_Semantic_Domain_Model_ProductionRule_RuleInterface $formula) {
		$this->formula = $formula;
	}
	
	/**
	 * Returns $formula
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_RuleInterface
	 */
	public function getFormula() {
		return $this->formula;
	}
	
}
?>