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
 * A Code Editor ViewHelper
 */
class Tx_Semantic_ViewHelpers_Form_CodeEditorViewHelper extends Tx_Fluid_ViewHelpers_Form_TextareaViewHelper {

	/**
	 * @var tx_t3editor
	 */
	protected $t3editor = NULL;

	/**
	 * Initialize the arguments.
	 *
	 * @return void
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('language', 'string', 'The programming language the code editor is for.', FALSE, 'ts');
	}

	/**
	 * Renders the codeeditor.
	 *
	 * @return string
	 */
	public function render() {
		$name = $this->getName();
		$this->registerFieldNameForFormTokenGeneration($name);

		$this->tag->forceClosingTag(TRUE);
		$this->tag->addAttribute('name', $name);
		$this->tag->addAttribute('id', 'code-editor');
		$this->tag->setContent(htmlspecialchars($this->getValue()));

		$this->setErrorClassAttribute();
		
		$pathToCodemirror = $GLOBALS['TSFE']->baseUrl . 'typo3/contrib/codemirror/';
		$javaScript = '<script src="typo3/contrib/codemirror/js/codemirror.js" type="text/javascript"></script>
			<script>
			var editor = CodeMirror.fromTextArea("code-editor", {
				path: "' . $pathToCodemirror . 'js/",
				parserfile: "parsesparql.js",
				stylesheet: "' . $GLOBALS['TSFE']->baseUrl . t3lib_extMgm::siteRelPath('semantic') . 'Resources/Public/Css/sparqlcolors.css",
				height: "250px",
				tabMode: "shift",
				textWrapping: false,
				disableSpellcheck: true
			});
			</script>';

		return $this->tag->render() . $javaScript;
	}

}
?>