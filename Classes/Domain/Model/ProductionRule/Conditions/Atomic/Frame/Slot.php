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
 * In RIF, the Frame element is used to serialize frame atomic formulas.
 * Accordingly, a Frame element must contain an object element and zero to many slot elements.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame_Slot extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * The order of the slot's sub-elements is significant and MUST be preserved.
	 * This is emphasized by the required value "yes" of the required attribute ordered.
	 * 
	 * @var bool
	 */
	protected $ordered = true;

	/**
	 * The first one that serializes the name of the attribute (or property)
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	protected $attribute;

	/**
	 * The second that serializes the attribute's value
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	protected $value;
	
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
	 * Sets $attribute
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $attribute
	 */
	public function setAttribute($attribute) {
		$this->attribute = $attribute;
	}
	
	/**
	 * Returns $attribute
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	public function getAttribute() {
		return $this->attribute;
	}
	
	/**
	 * Sets $value
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}
	
	/**
	 * Returns $value
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	public function getValue() {
		return $this->value;
	}
	
}
?>