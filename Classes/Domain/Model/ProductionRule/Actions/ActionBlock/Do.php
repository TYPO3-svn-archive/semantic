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
 * An action block is serialized using the Do element.
 * A Do element contains:
 *	zero or more actionVar sub-elements
 *	one actions sub-element
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionBlockInterface {

	/**
	 * Used to serialize one action variable declaration
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVar>
	 */
	protected $actionVars;
	
	/**
	 * The order of the actions is significant, and the order MUST be preserved, as emphasized by the required ordered="yes" attribute.
	 * 
	 * @var bool
	 */
	protected $actionsOrdered = true;
	
	/**
	 * A actions sub-element that serializes the sequence of actions in the action block, and that contains, accordingly, a sequence of
	 * one or more sub-elements of the ACTION class.
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionInterface>
	 */
	protected $actions;
	
	/**
	 * Sets actionVars
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVar> $actionVars
	 */
	public function setActionVars(Tx_Extbase_Persistence_ObjectStorage $actionVars) {
		$this->actionVars = $actionVars;
	}
	
	/**
	 * Adds a actionVar
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVar actionVar
	 */
	public function addActionVar(Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVar $actionVar) {
		$this->actionVars->attach($actionVar);
	}
	
	/**
	 * Removes a actionVar
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVar $actionVar
	 */
	public function remove(Tx_Semantic_Domain_Model_ProductionRule_ActionBlock_Do_ActionVar $actionVar) {
		$this->actionVars->detach($actionVar);
	}
	
	/**
	 * Returns actionVars
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage An object storage containing actionVars
	 */
	public function getActionVars() {
		return $this->actionVars;
	}
	
	/**
	 * Sets $actionsOrdered
	 *
	 * @param bool $actionsOrdered
	 */
	public function setActionsOrdered($actionsOrdered) {
		$this->actionsOrdered = $actionsOrdered;
	}
	
	/**
	 * Returns $actionsOrdered
	 *
	 * @return bool
	 */
	public function getActionsOrdered() {
		return $this->actionsOrdered;
	}
	
	/**
	 * Sets actions
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionInterface> $actions
	 */
	public function setActions(Tx_Extbase_Persistence_ObjectStorage $actions) {
		$this->actions = $actions;
	}
	
	/**
	 * Adds a action
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionInterface action
	 */
	public function addAction(Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionInterface $action) {
		$this->actions->attach($action);
	}
	
	/**
	 * Removes a action
	 * 
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionInterface $action
	 */
	public function remove(Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionInterface $action) {
		$this->actions->detach($action);
	}
	
	/**
	 * Returns actions
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage An object storage containing actions
	 */
	public function getActions() {
		return $this->actions;
	}

}
?>