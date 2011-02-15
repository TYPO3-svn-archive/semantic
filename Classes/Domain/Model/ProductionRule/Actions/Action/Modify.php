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
 * A compound modification is serialized using the Modify element.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Actions_Modify extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionInterface {

	/**
	 * The Modify element has one target sub-element that contains one Frame that represents the target of the action.
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame
	 */
	protected $target;

	/**
	 * Sets $target
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame $target
	 */
	public function setTarget(Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame $target) {
		$this->target = $target;
	}
	
	/**
	 * Returns $target
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Frame
	 */
	public function getTarget() {
		return $this->target;
	}

}
?>