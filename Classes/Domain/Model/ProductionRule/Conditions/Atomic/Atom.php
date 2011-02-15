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
 * In RIF, the Atom element is used to serialize a positional atomic formula.
 * The Atom element contains one op element, followed by zero or one args element.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Atom extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Conditions_AtomicInterface, Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface, Tx_Semantic_Domain_Model_ProductionRule_Actions_Action_AssertTargetInterface {

	/**
	 * The content of the op element must be a Const. It serializes the predicate symbol (the name of a relation).
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Const
	 */
	protected $op;
	
	/**
	 * The order of the arg's sub-elements is, therefore, significant and MUST be preserved.
	 * This is emphasized by the required value "yes" of the attribute ordered.
	 * 
	 * @var bool
	 */
	protected $argsOrdered = true;
	
	/**
	 * Contains args
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface>
	 */
	protected $args;
	
	/**
	 * Sets $argsOrdered
	 *
	 * @param bool $argsOrdered
	 */
	public function setArgsOrdered($argsOrdered) {
		$this->argsOrdered = $argsOrdered;
	}
	
	/**
	 * Returns $argsOrdered
	 *
	 * @return bool
	 */
	public function getArgsOrdered() {
		return $this->argsOrdered;
	}
	
	/**
	 * Sets args
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface> $args
	 */
	public function setArgs(Tx_Extbase_Persistence_ObjectStorage $args) {
		$this->args = $args;
	}
	
	/**
	 * Adds a argument
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface argument
	 */
	public function addArg(Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $argument) {
		$this->args->attach($argument);
	}
	
	/**
	 * Removes a argument
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $argument
	 */
	public function remove(Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $argument) {
		$this->args->detach($argument);
	}
	
	/**
	 * Returns args
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage An object storage containing args
	 */
	public function getArgs() {
		return $this->args;
	}
	
}
?>