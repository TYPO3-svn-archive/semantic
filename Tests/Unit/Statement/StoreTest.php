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
if (!class_exists('Tx_Extbase_Utility_ClassLoader', FALSE)) {
	require(t3lib_extmgm::extPath('extbase') . 'Classes/Utility/ClassLoader.php');
}

$classLoader = new Tx_Extbase_Utility_ClassLoader();
spl_autoload_register(array($classLoader, 'loadClass'));

set_include_path(get_include_path() . ':' . t3lib_extmgm::extPath('semantic') . 'Resources/Private/PHP/');

require_once(t3lib_extmgm::extPath('semantic') . 'Resources/Private/PHP/Erfurt/App.php');

$erfurtApp = Erfurt_App::getInstance();
$erfurtStore = $erfurtApp->getStore();
var_dump($erfurtStore->getAvailableModels(true));
echo 'test';
?>