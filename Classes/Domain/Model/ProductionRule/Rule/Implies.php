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
 * Conditional actions are serialized, in RIF-PRD, using the XML element Implies.
 * The Implies element contains an if sub-element and a then sub-element.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Rule_Implies extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_IriMetaInterface, Tx_Semantic_Domain_Model_ProductionRule_RuleInterface {
	
	/**
	 * The required if element contains an element from the FORMULA class of constructs, that serializes the condition of the rule
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface
	 */
	protected $if;
	
	/**
	 * The required then element contains one element from the ACTION_BLOCK class of constructs, that serializes its conlusion
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionBlockInterface
	 */
	protected $then;
	
	/**
	 * Sets $if
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface $if
	 */
	public function setIf(Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface $if) {
		$this->if = $if;
	}
	
	/**
	 * Returns $if
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface
	 */
	public function getIf() {
		return $this->if;
	}
	
	/**
	 * Sets $then
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionBlockInterface $then
	 */
	public function setThen(Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionBlockInterface $then) {
		$this->then = $then;
	}
	
	/**
	 * Returns $then
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionBlockInterface
	 */
	public function getThen() {
		return $this->then;
	}
	
}
?>