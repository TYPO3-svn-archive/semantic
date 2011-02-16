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
class Tx_Semantic_Rule_RuleEngine {
	
	/**
	 * Contains ruleset
	 * 
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Rule_Ruleset>
	 */
	protected $ruleset;
	
	/**
	 * Contains sessionBuilder
	 * 
	 * @var Tx_Semantic_Rule_SessionBuilder
	 */
	protected $sessionBuilder;
	
	/**
	 * Injector method for a Tx_Semantic_Rule_SessionBuilder
	 *
	 * @param Tx_Semantic_Rule_SessionBuilder $sessionBuilder
	 */
	public function injectSessionBuilder(Tx_Semantic_Rule_SessionBuilder $sessionBuilder) {
		$this->sessionBuilder = $sessionBuilder;
	}
	
	public function addRuleset(Tx_Semantic_Rule_Ruleset $ruleset) {
		$this->ruleset = $ruleset;
	}
	
	public function newStatelessSession() {
		return $this->sessionBuilder->build('Tx_Semantic_Rule_StatelessSessionInterface', $this->ruleset);
	}
	
}
?>