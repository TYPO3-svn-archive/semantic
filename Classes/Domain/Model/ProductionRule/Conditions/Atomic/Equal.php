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
 * In RIF, the Equal element is used to serialize equality atomic formulas.
 * The order of the sub-elements is not significant.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Conditions_Atomic_Equal extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Conditions_AtomicInterface, Tx_Semantic_Domain_Model_ProductionRule_Conditions_FormulaInterface {

	/**
	 * The content of the left element must be a construct from the TERM abstract class, that serialize the terms of the equality.
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	protected $left;
	
	/**
	 * The content of the right element must be a construct from the TERM abstract class, that serialize the terms of the equality.
	 * 
	 * @var 	
	 */
	protected $right;
	
	/**
	 * Sets $left
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $left
	 */
	public function setLeft($left) {
		$this->left = $left;
	}
	
	/**
	 * Returns $left
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	public function getLeft() {
		return $this->left;
	}
	
	/**
	 * Sets $right
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface $right
	 */
	public function setRight($right) {
		$this->right = $right;
	}
	
	/**
	 * Returns $right
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface
	 */
	public function getRight() {
		return $this->right;
	}
	
}
?>