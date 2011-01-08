<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 201 Jochen Rau <jochen.rau@typoplanet.de>
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
 * A generic Semantic exception
 */
class Tx_Semantic_ViewHelpers_ParseViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Parse the input string with EXT:contagged
	 *
	 * @param string $string The string to be parsed
	 * @return string The parsed string
	 */
	public function render($string = NULL) {
		if (!t3lib_extMgm::isLoaded('contagged')) return $string;
		if ($string === NULL) {
			$string = $this->renderChildren();
		}
		require_once (t3lib_extMgm::extPath('contagged') . 'class.tx_contagged.php');
		$parser = t3lib_div::makeInstance('tx_contagged');
		return $parser->parse($string);
	}
}

?>