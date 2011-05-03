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
class Tx_Semantic_Tests_Unit_Statement_StoreTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
}
*/

$GLOBALS["TSFE"]->fe_user = tslib_eidtools::initFeUser();

require_once(t3lib_extmgm::extPath('semantic') . 'Resources/Private/PHP/Erfurt/App.php');
if (!class_exists('Tx_Extbase_Utility_ClassLoader', FALSE)) require(t3lib_extmgm::extPath('extbase') . 'Classes/Utility/ClassLoader.php');
if (!class_exists('T3\Semantic\Resource\ClassLoader', FALSE)) require(t3lib_extmgm::extPath('semantic') . 'Classes/Resource/ClassLoader.php');
spl_autoload_register(array(new Tx_Extbase_Utility_ClassLoader(), 'loadClass'));
spl_autoload_register(array(new T3\Semantic\Resource\ClassLoader(), 'loadClass'));

$BE_USER = NULL;
/** @var $BE_USER t3lib_tsfeBeUserAuth */
if ($_COOKIE['be_typo_user']) {		// If the backend cookie is set, we proceed and checks if a backend user is logged in.
	$TYPO3_MISC['microtime_BE_USER_start'] = microtime(true);
	$TT->push('Back End user initialized','');

			// the value this->formfield_status is set to empty in order to disable login-attempts to the backend account through this script
		$BE_USER = t3lib_div::makeInstance('t3lib_tsfeBeUserAuth');	// New backend user object
		$BE_USER->OS = TYPO3_OS;
		$BE_USER->lockIP = $TYPO3_CONF_VARS['BE']['lockIP'];
		$BE_USER->start();			// Object is initialized
		$BE_USER->unpack_uc('');
		if ($BE_USER->user['uid'])	{
			$BE_USER->fetchGroupData();
			$TSFE->beUserLogin = 1;
		}
			// Unset the user initialization.
		if (!$BE_USER->checkLockToIP() || !$BE_USER->checkBackendAccessSettingsFromInitPhp() || !$BE_USER->user['uid']) {
			$BE_USER = NULL;
			$TSFE->beUserLogin=0;
		}
	$TT->pull();
	$TYPO3_MISC['microtime_BE_USER_end'] = microtime(true);
}

set_include_path(get_include_path() . ':' . t3lib_extmgm::extPath('semantic') . 'Resources/Private/PHP/');

$objectManager = new \T3\Semantic\Object\ObjectManager();

$start = microtime(true);

$knowledgeBase = $objectManager->get('\T3\Semantic\KnowledgeBase'); // @var \T3\Semantic\KnowledgeBase
$knowledgeBase->authenticate();

$wineModel = 'http://www.w3.org/TR/2003/PR-owl-guide-20031209/wine#';
$store = $knowledgeBase->getStore();

$availableModels = $store->getAvailableModels(true);
if (!isset($availableModels[$wineModel])) {
	$store->getNewModel($wineModel);
	$store->importRdf($wineModel, 'http://www.w3.org/TR/owl-guide/wine.rdf', 'xml');
} else {
$query = \T3\Semantic\Sparql\SimpleQuery::initWithString('
	PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>

	SELECT ?s ?p ?o
	FROM <http://www.w3.org/TR/2003/PR-owl-guide-20031209/wine#>
	WHERE {
		?s ?p ?o
	}
');
	var_dump($store->sparqlQuery($query));
}
echo '<pre>';
echo 'Zeit: ' . (microtime(true) - $start)*1000 . ' ms';
echo '</pre>';
?>