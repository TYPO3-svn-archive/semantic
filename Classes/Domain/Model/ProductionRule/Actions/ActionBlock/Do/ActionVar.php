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
 * An actionVar is used to serialize one action variable declaration.
 * Accordingly, an actionVar element must contain a Var sub-element, that serializes the declared variable;
 * followed by the serialization of an action variable binding, that assigns an initial value to the declared variable,
 * that is: either a frame or the empty element New;
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVar extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Contains ordered
	 * 
	 * @var bool
	 */
	protected $ordered = true;
	
	/**
	 * Contains value
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var
	 */
	protected $value;
	
	/**
	 * Contains initialValue
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVarInitialValueInterface
	 */
	protected $initialValue;
	
	/**
	 * Sets $ordered
	 *
	 * @param bool $ordered
	 */
	public function setOrdered($ordered) {
		$this->ordered = $ordered;
	}
	
	/**
	 * Returns $ordered
	 *
	 * @return bool
	 */
	public function getOrdered() {
		return $this->ordered;
	}

	/**
	 * Sets $value
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var $value
	 */
	public function setValue(Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var $value) {
		$this->value = $value;
	}
	
	/**
	 * Returns $value
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Var
	 */
	public function getValue() {
		return $this->value;
	}
	
	/**
	 * Sets $initialValue
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVarInitialValueInterface $initialValue
	 */
	public function setInitialValue(Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVarInitialValueInterface $initialValue) {
		$this->initialValue = $initialValue;
	}
	
	/**
	 * Returns $initialValue
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVarInitialValueInterface
	 */
	public function getInitialValue() {
		return $this->initialValue;
	}

}
?>