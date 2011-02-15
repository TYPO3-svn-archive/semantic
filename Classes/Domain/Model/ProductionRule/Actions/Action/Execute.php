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
 * The execution of an externally defined action is serialized using the Execute element.
 * The Execute element has one target sub-element that contains an Atom, that represents the externally defined action to be executed.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Actions_Execute extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Actions_ActionInterface {

	/**
	 * The Execute element has one target sub-element that contains an Atom, that represents the externally defined action to be executed.
	 * 
	 * The op Const in the Atom element must be a symbol of type rif:iri that must uniquely identify the externally defined action to be applied to the args TERM
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Atom
	 */
	protected $target;	

	/**
	 * Sets $target
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Atom $target
	 */
	public function setTarget(Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Atom $target) {
		$this->target = $target;
	}
	
	/**
	 * Returns $target
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Atom
	 */
	public function getTarget() {
		return $this->target;
	}
	
}
?>