<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Jochen Rau <jochen.rau@typoplanet.de>, typoplanet
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
 * QueryResultParser
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_Sparql_QueryResultParser implements Tx_Semantic_Domain_Model_Sparql_QueryResultParserInterface {

	/**
	 * A resource handler reference of the PHP Extpat parser
	 *
	 * @var resource
	 **/
	protected $parser;

	/**
	 * An array of results
	 *
	 * @var array
	 **/
	protected $results = array();

	/**
	 * The current result
	 *
	 * @var array
	 **/
	protected $currentResult = array();

	/**
	 * @var string
	 **/
	protected $currentName = '';

	/**
	 * @var string
	 **/
	protected $currentCharacterData = '';

	/**
	 * @var string
	 **/
	protected $currentType = '';

	/**
	 * @var string
	 **/
	protected $currentDataType;

	/**
	 * @var string
	 **/
	protected $currentLanguage;

	/**
	 * A flag indicating, if the character data of the current node should be processed.
	 *
	 * @var bool
	 **/
	protected $processCharacterData = FALSE;

	public function __construct() {
		$this->parser = xml_parser_create();
		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, 'handleElementStart', 'handleElementStop');
		xml_set_character_data_handler($this->parser, 'handleCharacterData');
	}

	public function __destruct() {
		xml_parser_free($this->parser);
	}

	public function parse($document) {
		$status = xml_parse($this->parser, $document);
		if ($status === 1) {
			return $this->results;
		} else {
			throw new Tx_Semantic_Domain_Model_Sparql_Exception_QueryResultParserException('Parser Error: "' . xml_error_string(xml_get_error_code($this->parser)) . '".', 1296481762);
		}
	}

	protected function handleElementStart($parser, $elementName, $elementAttributes) {
		switch ($elementName) {
			case 'VARIABLE':
				$this->results['variables'][] = $elementAttributes['NAME'];
				$this->processCharacterData = FALSE;
				break;
			case 'BINDING':
				$this->currentName = $elementAttributes['NAME'];
				$this->processCharacterData = FALSE;
				break;
			case 'LITERAL':
				$this->currentType = 'literal';
				if (isset($elementAttributes['DATATYPE'])) {
					$this->currentDatatype = $elementAttributes['DATATYPE'];
				}
				if (isset($elementAttributes['XML:LANG'])) {
					$this->currentLanguage = $elementAttributes['XML:LANG'];
				}
				$this->processCharacterData = TRUE;
				break;
			case 'BNODE':
				$this->currentType = 'bnode';
				$this->processCharacterData = TRUE;
				break;
			case 'URI':
				$this->currentType = 'uri';
				$this->processCharacterData = TRUE;
				break;
		}
	}

	protected function handleElementStop($parser, $elementName) {
		switch ($elementName) {
			case 'BINDING':
				$this->currentResult[$this->currentName] = array(
					'value' => $this->currentCharacterData,
					'type' => $this->currentType
					);
				if ($this->currentDatatype !== NULL) {
					$this->currentResult[$this->currentName]['datatype'] = $this->currentDatatype;
					$this->currentDatatype = NULL;					
				}
				if ($this->currentLanguage !== NULL) {
					$this->currentResult[$this->currentName]['language'] = $this->currentLanguage;
					$this->currentLanguage = NULL;
				}
				$this->currentCharacterData = '';
				break;
			case 'LITERAL':
				$this->processCharacterData = FALSE;
				break;
			case 'BNODE':
				$this->processCharacterData = FALSE;
				break;
			case 'URI':
				$this->processCharacterData = FALSE;
				break;
			case 'RESULT':
				$this->results['results'][] = $this->currentResult;
				$this->currentResult = array();
				break;
		}
	}

	protected function handleCharacterData($parser, $characterData) {
		if ($this->processCharacterData === TRUE) {
			$this->currentCharacterData .= $characterData;
		}
	}

}
?>