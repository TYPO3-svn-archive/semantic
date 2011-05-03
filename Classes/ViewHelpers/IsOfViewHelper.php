<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 201 Jochen Rau <jochen.rau@typoplanet.de>
 *  All rights reserved
 *
 *  This class is a port of the corresponding class of the
 *  {@link http://aksw.org/Projects/Erfurt Erfurt} project.
 *  All credits go to the Erfurt team.
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
 * A view helper
 */
class Tx_Semantic_ViewHelpers_IsOfViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Checks if the given object is an instance of the given class name
	 *
	 * @param string $type The type
	 * @param mixed $subject The subject to be tested
	 * @return boolean TRUE if the given subject is of the given type
	 */
	public function render($type, $subject = NULL) {
		if ($subject === NULL) {
			$subject = $this->renderChildren();
		}
		if (is_object($subject)) {
			return $subject instanceof $type;
		} elseif (is_array($subject) && isset($subject['type'])) {
			return $subject['type'] === $type;
		} else {
			return FALSE;
		}
	}
}

?>