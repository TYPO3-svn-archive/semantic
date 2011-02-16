<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Thomas Maroschik <tmaroschik@dfau.de>
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
/*
class Tx_Semantic_Tests_Unit_Rule_RuleBuilderTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	public function buildRulesetByProductionRules() {
		
	}

}
*/
if (!class_exists('Tx_Extbase_Utility_ClassLoader', FALSE)) {
	require(t3lib_extmgm::extPath('extbase') . 'Classes/Utility/ClassLoader.php');
}

$classLoader = new Tx_Extbase_Utility_ClassLoader();
spl_autoload_register(array($classLoader, 'loadClass'));


class Applicant {
    public $name;
    public $age;
    public function __construct($name, $age) {
    	$this->name = $name;
    	$this->age = $age;
    }
}
class Application {
	public $dateApplied;
	public $applicant;
	public function __construct($dateApplied, $applicant) {
		$this->dateApplied = $dateApplied;
		$this->applicant = $applicant;
	}
}
		
$rulesetBuilder = new Tx_Semantic_Rule_RulesetBuilder();
$ruleset = $rulesetBuilder->build();

$ruleEngine = new Tx_Semantic_Rule_RuleEngine();
$ruleEngine->injectSessionBuilder(new Tx_Semantic_Rule_SessionBuilder());
$ruleEngine->addRuleset($ruleset);

$applicant1 = new Applicant('john', 19);
$application1 = new Application(2, $applicant1);

$applicant2 = new Applicant('doe', 16);
$application2 = new Application(1, $applicant2);

$statelessSession = $ruleEngine->newStatelessSession();
$statelessSession->execute(array($applicant1, $application1, $applicant2, $application2));

?>