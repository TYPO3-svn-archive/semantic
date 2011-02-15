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
 * A disjunction is serialized using the Or element.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Conditions_Formula_Or extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface {
	
	/**
	 * The Or element contains zero or more formula sub-elements, each containing an element of the FORMULA group, that serializes one of the disjuncts.
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface>
	 */
	protected $formulas;
	
	/**
	 * Sets formulas
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface> $formulas
	 */
	public function setFormulas(Tx_Extbase_Persistence_ObjectStorage $formulas) {
		$this->formulas = $formulas;
	}
	
	/**
	 * Adds a formula
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface formula
	 */
	public function addFormula(Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface $formula) {
		$this->formulas->attach($formula);
	}
	
	/**
	 * Removes a formula
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface $formula
	 */
	public function remove(Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface $formula) {
		$this->formulas->detach($formula);
	}
	
	/**
	 * Returns formulas
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage An object storage containing formulas
	 */
	public function getFormulas() {
		return $this->formulas;
	}
	
}
?>