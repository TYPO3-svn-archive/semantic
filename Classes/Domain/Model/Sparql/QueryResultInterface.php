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
 * Sparql_QueryResultInterface
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
interface Tx_Semantic_Domain_Model_Sparql_QueryResultInterface extends Countable, Iterator, ArrayAccess {

	/**
	 * Setter for variable names
	 *
	 * @param array $variables Set variable names
	 * @return void
	 * @api
	 */
	public function setVariables(array $variables);

	/**
	 * Adds a variable name
	 *
	 * @param string $boundVariableName A variable name
	 * @return void
	 * @api
	 */
	public function addVariable($variable);

	/**
	 * Getter for variables
	 *
	 * @return array variables
	 * @api
	 */
	public function getVariables();

	/**
	 * Setter for results
	 *
	 * @param string $results results
	 * @return void
	 */
	public function setResults($results);

	/**
	 * Getter for results
	 *
	 * @return string results
	 */
	public function getResults();

	/**
	 * Returns a clone of the query object
	 *
	 * @return Tx_Semantic_Domain_Model_Sparql_QueryInterface
	 * @api
	 */
	public function getQuery();

	/**
	 * Returns the first object in the result set
	 *
	 * @return object
	 * @api
	 */
	public function getFirst();
	
}
?>