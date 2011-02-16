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
class Tx_Semantic_Rule_StatelessSession implements Tx_Semantic_Rule_StatelessSessionInterface {
	
	/**
	 * Contains ruleset
	 * 
	 * @var Tx_Semantic_Rule_Ruleset
	 */
	protected $ruleset;
	
	/**
	 * Contains facts
	 * 
	 * @var array
	 */
	protected $facts;
	
	/**
	 * Constructor method for a stateless session
	 * 
	 * @param Tx_Semantic_Rule_Ruleset $ruleset
	 */
	public function __construct(Tx_Semantic_Rule_Ruleset $ruleset) {
		$this->ruleset = $ruleset;
	}
	
	/**
	 * Execute the rules inside a stateless session upon a given set of rules
	 * 
	 * @param mixed $facts
	 */
	public function execute($facts) {
		$this->facts = $facts;
		$this->ruleset->evaluate($facts);
	}
}
?>