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
class Tx_Semantic_Rule_Ruleset_ConditionNode extends Tx_Semantic_Rule_Ruleset_AbstractNode {
	
	/**
	 * Contains subjects
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage
	 */
	protected $subjects;
	
	/**
	 * Contains propertyPath
	 * 
	 * @var string
	 */
	protected $propertyPath;
	
	/**
	 * Contains predicate
	 * 
	 * @var string
	 */
	protected $predicate;
	
	/**
	 * Contains object
	 * 
	 * @var mixed
	 */
	protected $object;
	
	/**
	 * Constructor method for a condition node
	 * @param string $propertyPath
	 * @param string $predicate
	 * @param string $object
	 */
	public function __construct($propertyPath, $predicate = null, $object = null) {
		$this->reset();
		$this->propertyPath = $propertyPath;
		$this->predicate = $predicate;
		$this->object = $object;
		parent::__construct();
	}
	
	/**
	 * Add an item to the nodes memory
	 * 
	 * @param Object $object
	 */
	public function add($object) {
		$this->subjects->attach($object);
	}
	
	/**
	 * Remove an item from the nodes memory
	 * 
	 * @param Object $object
	 */
	public function remove($object) {
		$this->subjects->detach($object);
	}
	
	/**
	 * Resets the nodes memory
	 */
	public function reset() {
		$this->subjects = new Tx_Extbase_Persistence_ObjectStorage();
		parent::reset();
	}
	
	/* (non-PHPdoc)
	 * @see Tx_Semantic_Rule_Ruleset_NodeInterface::evaluate()
	 */
	public function evaluate() {
		foreach ($this->subjects as $subject) {
			$subjectValue = Tx_Extbase_Reflection_ObjectAccess::getPropertyPath($subject, $this->propertyPath);
			eval('$isTrue = ' . $subjectValue . $this->predicate . $this->object . ';');
			if ($isTrue) {
				foreach ($this->descendentNodes as $descendentNode) {
					$descendentNode->add($subject);
				}
			}
		}
		$this->finished = true;
		foreach ($this->descendentNodes as $descendentNode) {
			$descendentNode->evaluate();
		}
	}
	
}
?>