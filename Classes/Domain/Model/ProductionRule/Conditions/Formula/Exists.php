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
 * An existentially quantified formula is serialized using the Exists element.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Conditions_Formula_Exists extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface {
	
	/**
	 * One or more declare sub-elements, each containing one Var element that serializes one of the existentially quantified variables;
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var>
	 */
	protected $declarations;
	
	/**
	 * Exactly one required formula sub-element that contains an element from the FORMULA abstract class, that serializes the formula in the scope of the quantifier.
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface
	 */
	protected $formula;

	/**
	 * Sets declarations
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var> $declarations
	 */
	public function setDeclarations(Tx_Extbase_Persistence_ObjectStorage $declarations) {
		$this->declarations = $declarations;
	}
	
	/**
	 * Adds a declaration
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var declaration
	 */
	public function addDeclaration(Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var $declaration) {
		$this->declarations->attach($declaration);
	}
	
	/**
	 * Removes a declaration
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var $declaration
	 */
	public function remove(Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var $declaration) {
		$this->declarations->detach($declaration);
	}
	
	/**
	 * Returns declarations
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage An object storage containing declarations
	 */
	public function getDeclarations() {
		return $this->declarations;
	}
	
	/**
	 * Sets $formula
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface $formula
	 */
	public function setFormula($formula) {
		$this->formula = $formula;
	}
	
	/**
	 * Returns $formula
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface
	 */
	public function getFormula() {
		return $this->formula;
	}
	
}
?>