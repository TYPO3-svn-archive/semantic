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
class Tx_Semantic_Rule_Ruleset_JoinNode extends Tx_Semantic_Rule_Ruleset_AbstractNode {

	/**
	 * Contains leftType
	 * 
	 * @var string
	 */
	protected $leftType;
	
	/**
	 * Contains rightType
	 * 
	 * @var string
	 */
	protected $rightType;
	
	/**
	 * Contains leftPropertyPath
	 * 
	 * @var string
	 */
	protected $leftPropertyPath;
	
	/**
	 * Contains rightPropertyPath
	 * 
	 * @var string
	 */
	protected $rightPropertyPath;
	
	/**
	 * Contains memory
	 * 
	 * @var array
	 */
	protected $memory;
	
	/**
	 * Contains leftValueIndex
	 * 
	 * @var array
	 */
	protected $leftValueIndex;
	
	/**
	 * Contains rightValueIndex
	 * 
	 * @var array
	 */
	protected $rightValueIndex;
	
	public function __construct($leftType, $rightType, $leftPropertyPath, $rightPropertyPath) {
		$this->leftType = $leftType;
		$this->leftPropertyPath = $leftPropertyPath;
		$this->rightType = $rightType;
		$this->rightPropertyPath = $rightPropertyPath;
		$this->reset();
		parent::__construct();
	}
	
	/* (non-PHPdoc)
	 * @see Tx_Semantic_Rule_Ruleset_NodeInterface::add()
	 */
	public function add($object) {
		if ($object instanceof $this->leftType) {
			$this->addToMemory('left', $object);
			return;
		}
		if ($object instanceof $this->rightType) {
			$this->addToMemory('right', $object);
		}
	}
	
	/* (non-PHPdoc)
	 * @see Tx_Semantic_Rule_Ruleset_NodeInterface::remove()
	 */
	public function remove($object) {
		// TODO
	}
	
	/* (non-PHPdoc)
	 * @see Tx_Semantic_Rule_Ruleset_NodeInterface::reset()
	 */
	public function reset() {
		$this->memory = array();
		$this->leftValueIndex = array();
		$this->rightValueIndex = array();
	}
	
	/* (non-PHPdoc)
	 * @see Tx_Semantic_Rule_Ruleset_NodeInterface::evaluate()
	 */
	public function evaluate() {
		if($this->allAscendentNodesHaveFinished()) {
			$leftJoinedValues = array_intersect($this->leftValueIndex, $this->rightValueIndex);
			$rightJoinedValues = array_intersect($this->rightValueIndex, $this->leftValueIndex);
			$innerJoinedValues = array_unique(array_merge($leftJoinedValues, $rightJoinedValues));
			foreach ($innerJoinedValues as $innerJoinedValue) {
				$leftKeys = array_keys($this->leftValueIndex, $innerJoinedValue); 
				$rightKeys = array_keys($this->rightValueIndex, $innerJoinedValue);
				$alternatives = $this->arrayAlternatives($leftKeys, $rightKeys);
				foreach ($alternatives as $tuple) {
					$tuple[0] = $this->memory[$tuple[0]];
					$tuple[1] = $this->memory[$tuple[1]];
					foreach ($this->descendentNodes as $descendentNode) {
						$descendentNode->add($tuple);
					}
				}
			}
		}
	}
	
	protected function allAscendentNodesHaveFinished() {
		$allFinished = true;
		foreach ($this->ascendentNodes as $ascendentNode) {
			if (!$ascendentNode->hasFinished()) {
				$allFinished = false;
			}
		}
		return $allFinished;
	}
	
	/**
	 * Adds an object either to a left or right hand side memory
	 * 
	 * @param string $side
	 * @param Object $object
	 */
	protected function addToMemory($side, $object) {
		$lastInsertId = array_push($this->memory, $object) - 1;
		if (empty($this->{$side.'PropertyPath'})) {
			$subject = $object; 
		} else {
			$subject = Tx_Extbase_Reflection_ObjectAccess::getPropertyPath($object, $this->{$side.'PropertyPath'});
		}
		if (!$subject instanceof DateTime && is_object($subject)) {
			$subject = spl_object_hash($subject);
		}
		$this->{$side.'ValueIndex'}[$lastInsertId] = $subject;
	}

	/**
	 * Return alternatives defined by values of each parameters.
	 *
	 * Exemple :
	 *
	 * array_alternatives(array('foo','bar'), array('baz', 'qux'));
	 * array(
	 *     array('foo', 'baz'),
	 *     array('bar', 'baz'),
	 *     array('foo', 'qux'),
	 *     array('bar', 'qux'),
	 * );
	 *
	 * array_alternatives(array('a'), array('simple-minded'), array('solution'));
	 * array(
	 *     array('a', 'simple-minded', 'solution')
	 * );
	 *
	 * array_alternatives(array('a'), array('red', 'blue'), array('car'));
	 * array(
	 *     array('a', 'red',  'car'),
	 *     array('a', 'blue', 'car'),
	 * );
	 * 
	 * @param array $first_element
	 * @param array $second_element
	 * @return array
	 * @author Xavier Barbosa
	 */
	public function arrayAlternatives(array $first_element, array $second_element) {
	    $lists = func_get_args();
	    $total_lists = func_num_args();
	   
	    for($i=0; $i<$total_lists; $i++)
	    {
	        $list =& $lists[$i];
	        if (is_array($list) === FALSE)
	            throw new Exception("Parameter $i is not an array.");
	        if (count($list) === 0)
	            throw new Exception("Parameter $i has no element.");
	        unset($list);
	    }
	   
	    // Initialize our alternatives
	    $alternatives = array();
	    foreach($lists[0] as &$value)
	    {
	        array_push($alternatives, array($value));
	        unset($value);
	    }
	    unset($lists[0]);
	   
	    // Process alternatives
	    for($i=1; $i<$total_lists; $i++)
	    {
	        $list =& $lists[$i];
	       
	        $new_alternatives = array();
	        foreach($list as &$value)
	        {
	            foreach($alternatives as $_)
	            {
	                array_push($_, $value);
	                array_push($new_alternatives, $_);
	            }
	        }
	       
	        // Rotate references, it's cheaper than copy array like `$alternatives = $new_alternatives;`
	        $alternatives =& $new_alternatives;
	        unset($new_alternatives, $list, $lists[$i]);
	    }
	   
	    return $alternatives;
	}
	
}
?>