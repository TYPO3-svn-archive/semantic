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
class Tx_Semantic_Rule_Ruleset {
	
	/**
	 * Contains typeNodes
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Rule_Ruleset_TypeNode>
	 */
	protected $typeNodes;
	
	/**
	 * Constructor method for a ruleset
	 * 
	 * @param Tx_Extbase_Persistence_ObjectStorage $typeNodes
	 */
	public function __construct(Tx_Extbase_Persistence_ObjectStorage $typeNodes) {
		$this->typeNodes = $typeNodes;
	}

	public function evaluate($facts) {
		// Index the used types
		$typeMap = array();
		foreach ($facts as $fact) {
			$types = class_parents($fact);
			array_unshift($types, get_class($fact));
			foreach ($types as $type) {
				$typeMap[$type][] = $fact;
			}
		}
		// Fill the typeNodes with the desired facts
		$requiredTypes = array();
		foreach ($this->typeNodes as $typeNode) {
			if (count($typeMap[$typeNode->getType()]) > 0) {
				foreach ($typeMap[$typeNode->getType()] as $fact) {
					$typeNode->add($fact);
				}
			}
		}
		// Start evaluation
		foreach ($this->typeNodes as $typeNode) {
			$typeNode->evaluate();
		}
	}
}
?>