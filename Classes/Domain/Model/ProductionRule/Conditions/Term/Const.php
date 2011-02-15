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
 * In RIF, the Const element is used to serialize a constant.
 * The Const element has a required type attribute and an optional xml:lang attribute.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_ProductionRule_Conditions_Term_Const extends Tx_Extbase_DomainObject_AbstractEntity implements Tx_Semantic_Domain_Model_ProductionRule_Conditions_TermInterface {
	
	/**
	 * The value of the type attribute is the identifier of the Const symbol space. It must be a rif:iri.
	 * 
	 * @var Tx_Semantic_Domain_Model_ProductionRule_IriInterface
	 */
	protected $type;
	
	/**
	 * The xml:lang attribute, as defined by 2.12 Language Identification of XML 1.0 or its successor specifications in the W3C
	 * recommendation track, is optionally used to identify the language for the presentation of the Const to the user. It is
	 * allowed only in association with constants of the type rdf:plainLiteral. A compliant implementation MUST ignore the xml:lang
	 * attribute if the type of the Const is not rdf:plainLiteral.
	 * 
	 * @var string
	 */
	protected $lang;
	
	/**
	 * Contains value
	 * 
	 * @var string
	 */
	protected $value;
	
	/**
	 * Sets $type
	 *
	 * @param Tx_Semantic_Domain_Model_ProductionRule_IriInterface $type
	 */
	public function setType(Tx_Semantic_Domain_Model_ProductionRule_IriInterface $type) {
		$this->type = $type;
	}
	
	/**
	 * Returns $type
	 *
	 * @return Tx_Semantic_Domain_Model_ProductionRule_IriInterface
	 */
	public function getType() {
		return $this->type;
	}
	
	/**
	 * Sets $lang
	 *
	 * @param string $lang
	 */
	public function setLang($lang) {
		$this->lang = $lang;
	}
	
	/**
	 * Returns $lang
	 *
	 * @return string
	 */
	public function getLang() {
		return $this->lang;
	}
	
	/**
	 * Sets $value
	 *
	 * @param string $value
	 */
	public function setValue($value) {
		$this->value = $value;
	}
	
	/**
	 * Returns $value
	 *
	 * @return string
	 */
	public function getValue() {
		return $this->value;
	}
	
}
?>