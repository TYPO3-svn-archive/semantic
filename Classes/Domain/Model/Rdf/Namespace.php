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

/**
 * Rdf_Namespace
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_Rdf_Namespace extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * The prefix of the namespace.
	 * @var string
	 * @validate NotEmpty
	 */
	protected $prefix;
	
	/**
	 * iri
	 * @var string
	 */
	protected $iri;
	
	/**
	 * Setter for prefix
	 *
	 * @param string $prefix The prefix of the namespace.
	 * @return void
	 */
	public function setPrefix($prefix) {
		$this->prefix = $prefix;
	}

	/**
	 * Getter for prefix
	 *
	 * @return string The prefix of the namespace.
	 */
	public function getPrefix() {
		return $this->prefix;
	}
	
	/**
	 * Setter for iri
	 *
	 * @param string $iri iri
	 * @return void
	 */
	public function setIri($iri) {
		$this->iri = (string) $iri;
	}

	/**
	 * Getter for iri
	 *
	 * @return string iri
	 */
	public function getIri() {
		return $this->iri;
	}
	
}
?>