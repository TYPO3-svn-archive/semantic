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
 * In RIF, the Member element is used to serialize membership atomic formulas.
 * The Member element contains two required sub-elements.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Member extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Conditions_AtomicInterface, Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface, Tx_Semantic_Domain_Model_ProductionRule_Actions_Action_AssertTargetInterface {

	/**
	 * The instance elements must be a construct from the TERM abstract class that serializes the reference to the object
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	protected $instance;
	
	/**
	 * The class element must be a construct from the TERM abstract class that serializes the reference to the class.
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	protected $class;
	
	/**
	 * Sets $instance
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $instance
	 */
	public function setInstance($instance) {
		$this->instance = $instance;
	}
	
	/**
	 * Returns $instance
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	public function getInstance() {
		return $this->instance;
	}
	
	/**
	 * Sets $class
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $class
	 */
	public function setClass($class) {
		$this->class = $class;
	}
	
	/**
	 * Returns $class
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	public function getClass() {
		return $this->class;
	}
	
}
?>