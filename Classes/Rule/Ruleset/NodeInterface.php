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
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
interface Tx_Semantic_Rule_Ruleset_NodeInterface {
	
	/**
	 * Add an item to the nodes memory
	 * 
	 * @param Object $object
	 */
	public function add($object);
	
	/**
	 * Remove an item to the nodes memory
	 * 
	 * @param Object $object
	 */
	public function remove($object);
	
	/**
	 * Resets the nodes memory
	 */
	public function reset();
	
	/**
	 * Add an ascendent node to the list of descendent nodes
	 * 
	 * @param Tx_Semantic_Rule_Ruleset_NodeInterface $node
	 */
	public function addAscendentNode(Tx_Semantic_Rule_Ruleset_NodeInterface $node);
	
	/**
	 * Add an descendent node to the list of descendent nodes
	 * 
	 * @param Tx_Semantic_Rule_Ruleset_NodeInterface $node
	 */
	public function addDescendentNode(Tx_Semantic_Rule_Ruleset_NodeInterface $node);
	
	/**
	 * Start the evaluation
	 */
	public function evaluate();
	
}
?>