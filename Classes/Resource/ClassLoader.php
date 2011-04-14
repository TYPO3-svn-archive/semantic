<?php
declare(ENCODING = 'utf-8');
namespace T3\Semantic\Resource;

/*                                                                        *
 * This script belongs to the FLOW3 framework.                            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * Class Loader implementation which loads .php files found in the classes
 * directory of an object.
 *
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class ClassLoader {

	/**
	 * Define some global constants
	 */
	public function __construct() {
		define('EF_BASE', \t3lib_extmgm::extPath('semantic') . 'Resources/Private/PHP/Erfurt/');
		define('ZEND_BASE', \t3lib_extmgm::extPath('semantic') . 'Resources/Private/PHP/Zend/');
	}

	/**
	 * Loads php files containing classes or interfaces found in the classes directory of
	 * a package and and erfurt classes
	 *
	 * @param string $className Name of the class/interface to load
	 * @return void
	 * @author Thomas Maroschik <tmaroschik@dfau.de>
	 */
	public function loadClass($className) {
		$classNameParts = explode('\\', $className);
		$extensionName = \t3lib_div::camelCaseToLowerCaseUnderscored($classNameParts[1]);
		if (\t3lib_div::isFirstPartOfStr($classNameParts[0], 'Erfurt')) {
			$classNameParts = explode('_', $classNameParts[0]);
			$classFilePathAndName = EF_BASE;
			$classFilePathAndName .= implode(array_slice($classNameParts, 1, -1), '/') . '/';
			$classFilePathAndName .= end($classNameParts) . '.php';
		} elseif (\t3lib_div::isFirstPartOfStr($classNameParts[0], 'Zend')) {
			$classNameParts = explode('_', $classNameParts[0]);
			$classFilePathAndName = ZEND_BASE;
			$classFilePathAndName .= implode(array_slice($classNameParts, 1, -1), '/') . '/';
			$classFilePathAndName .= end($classNameParts) . '.php';
		} else {
			$classFilePathAndName = \t3lib_extmgm::extPath($extensionName) . 'Classes/';
			$classFilePathAndName .= implode(array_slice($classNameParts, 2, -1), '/') . '/';
			$classFilePathAndName .= end($classNameParts) . '.php';
		}
		if (isset($classFilePathAndName) && file_exists($classFilePathAndName)) {
			require($classFilePathAndName);
		} else {
		}
	}

}

?>