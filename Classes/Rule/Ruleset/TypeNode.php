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
class Tx_Semantic_Rule_Ruleset_TypeNode extends Tx_Semantic_Rule_Ruleset_AbstractNode {

	/**
	 * Contains type
	 * 
	 * @var string
	 */
	protected $type;
	
	/**
	 * Contains members
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage
	 */
	protected $members;
	
	/**
	 * Contains descendentNodes
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage
	 */
	protected $descendentNodes;
	
	/**
	 * Constructor method for a type node
	 * @param string $type
	 */
	public function __construct($type) {
		$this->reset();
		$this->type = $type;
		parent::__construct();
	}
	
	/**
	 * Add an item to the nodes memory
	 * 
	 * @param Object $object
	 */
	public function add($object) {
		if ($object instanceof $this->type) {
			$this->members->attach($object);
		}
	}
	
	/**
	 * Remove an item from the nodes memory
	 * 
	 * @param Object $object
	 */
	public function remove($object) {
		$this->members->detach($object);
	}
	
	/**
	 * Resets the nodes memory
	 */
	public function reset() {
		$this->members = new Tx_Extbase_Persistence_ObjectStorage();
		parent::__construct();
	}
	
	/**
	 * Sets $type
	 *
	 * @param string $type
	 */
	public function setType($type) {
		$this->type = $type;
	}
	
	/**
	 * Returns $type
	 *
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}
	
	
	/* (non-PHPdoc)
	 * @see Tx_Semantic_Rule_Ruleset_NodeInterface::evaluate()
	 */
	public function evaluate() {
		$this->finished = true;
		foreach ($this->descendentNodes as $descendentNode) {
			foreach ($this->members as $member) {
				$descendentNode->add($member);
			}
			$descendentNode->evaluate();
		}
	}
	
}
?>