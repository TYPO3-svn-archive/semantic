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
 * Rdf_Graph
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_Rdf_Graph extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * name
	 * @var string
	 */
	protected $name;
	
	/**
	 * statement
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_Rdf_Statement>
	 */
	protected $statement;
	
	/**
	 * Setter for name
	 *
	 * @param string $name name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Getter for name
	 *
	 * @return string name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * Setter for statement
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_Rdf_Statement> $statement statement
	 * @return void
	 */
	public function setStatement(Tx_Extbase_Persistence_ObjectStorage $statement) {
		$this->statement = $statement;
	}

	/**
	 * Getter for statement
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Semantic_Domain_Model_Rdf_Statement> statement
	 */
	public function getStatement() {
		return $this->statement;
	}
	
	/**
	 * Adds a Rdf_Statement
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Statement the Rdf_Statement to be added
	 * @return void
	 */
	public function addStatement(Tx_Semantic_Domain_Model_Rdf_Statement $statement) {
		$this->statement->attach($statement);
	}
	
	/**
	 * Removes a Rdf_Statement
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Statement the Rdf_Statement to be removed
	 * @return void
	 */
	public function removeStatement(Tx_Semantic_Domain_Model_Rdf_Statement $statement) {
		$this->statement->detach($statement);
	}
	
}
?>