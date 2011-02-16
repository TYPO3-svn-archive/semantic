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
 * ProductionRule_Group
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
abstract class Tx_Semantic_Rule_Ruleset_AbstractNode implements Tx_Semantic_Rule_Ruleset_NodeInterface {

	/**
	 * Contains ascendentNodes
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage
	 */
	protected $ascendentNodes;
	
	/**
	 * Contains descendentNodes
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage
	 */
	protected $descendentNodes;
	
	/**
	 * A signal for the descendent nodes, that this node has finalized all its work
	 * 
	 * @var bool
	 */
	protected $finished = false;
	
	/**
	 * Constructor method for a node
	 */
	public function __construct() {
		$this->ascendentNodes = new Tx_Extbase_Persistence_ObjectStorage();
		$this->descendentNodes = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	 * Add an ascendent node to the list of descendent nodes
	 * 
	 * @param Tx_Semantic_Rule_Ruleset_NodeInterface $node
	 */
	public function addAscendentNode(Tx_Semantic_Rule_Ruleset_NodeInterface $node) {
		if (!$this->ascendentNodes->contains($node)) {
			$this->ascendentNodes->attach($node);
			$node->addDescendentNode($this);
		}
	}
	
	/**
	 * Add an descendent node to the list of descendent nodes
	 * 
	 * @param Tx_Semantic_Rule_Ruleset_NodeInterface $node
	 */
	public function addDescendentNode(Tx_Semantic_Rule_Ruleset_NodeInterface $node) {
		if (!$this->descendentNodes->contains($node)) {
			$this->descendentNodes->attach($node);
			$node->addAscendentNode($this);
		}
	}
	
	public function hasFinished() {
		return $this->finished;
	}
	
	/* (non-PHPdoc)
	 * @see Tx_Semantic_Rule_Ruleset_NodeInterface::reset()
	 */
	public function reset() {
		$this->finished = false;
	}
}
?>