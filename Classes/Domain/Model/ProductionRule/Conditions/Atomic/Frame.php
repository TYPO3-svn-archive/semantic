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
class Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Conditions_AtomicInterface, Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface, Tx_Semantic_Domain_Model_ProductionRule_Actions_Action_AssertTargetInterface, Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVarInitialValueInterface {

	/**
	 * An object element, that contains an element of the TERM abstract class that serializes the reference to the frame's object.
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	protected $object;
	
	/**
	 * Zero to many slot elements, serializing an attribute-value pair as a pair of elements of the TERM abstract class.
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame_Slot>
	 */
	protected $slots;
	
	/**
	 * Sets $object
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $object
	 */
	public function setObject($object) {
		$this->object = $object;
	}
	
	/**
	 * Returns $object
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	public function getObject() {
		return $this->object;
	}
	
	/**
	 * Sets slots
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame_Slot> $slots
	 */
	public function setSlots(Tx_Extbase_Persistence_ObjectStorage $slots) {
		$this->slots = $slots;
	}
	
	/**
	 * Adds a slot
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame_Slot slot
	 */
	public function addSlot(Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame_Slot $slot) {
		$this->slots->attach($slot);
	}
	
	/**
	 * Removes a slot
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame_Slot $slot
	 */
	public function remove(Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame_Slot $slot) {
		$this->slots->detach($slot);
	}
	
	/**
	 * Returns slots
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage An object storage containing slots
	 */
	public function getSlots() {
		return $this->slots;
	}
	
}
?>