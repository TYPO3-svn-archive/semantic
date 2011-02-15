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
class Tx_Semantic_Domain_Model_ProductionRule_Actions_Assert extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionInterface {

	/**
	 * The Assert element has one target sub-element that contains an Atom, a Frame or a Member element that represents the target of the action.
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Actions_Action_AssertTargetInterface
	 */
	protected $target;

	/**
	 * Sets $target
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Actions_Action_AssertTargetInterface $target
	 */
	public function setTarget(Tx_Semantic_Domain_Model_ProductionRule_Actions_Action_AssertTargetInterface $target) {
		$this->target = $target;
	}
	
	/**
	 * Returns $target
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Actions_Action_AssertTargetInterface
	 */
	public function getTarget() {
		return $this->target;
	}
	
}
?>