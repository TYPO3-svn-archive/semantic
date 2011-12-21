<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Jochen Rau <jochen.rau@typoplanet.de>, typoplanet
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

class Tx_Semantic_View_ContentView extends Tx_Fluid_View_TemplateView {

	/**
	 * The template source. This is a string containing the fluid template code.
	 * @var string
	 */
	protected $templateSource = '';

	/**
	 * @param string $actionName Name of the action. If NULL, will be taken from request.
	 * @return string The template source code.
	 */
	public function getTemplateSource($actionName = NULL) {
		if (trim($this->templateSource) !== '') {
			return $this->templateSource;
		} else {
			return parent::getTemplateSource($actionName);
		}
	}

	public function getTemplateIdentifier($actionName = NULL) {
		if (trim($this->templateSource) !== '') {
			return sha1($this->templateSource);
		} else {
			return parent::getTemplateIdentifier($actionName);
		}
	}

	/**
	 * @param  $templateSource The template source code.
	 * @return void
	 */
	public function setTemplateSource($templateSource) {
		$this->templateSource = (string) $templateSource;
	}
}
