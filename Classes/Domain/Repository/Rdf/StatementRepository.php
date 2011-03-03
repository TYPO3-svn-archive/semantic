<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 
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
 * Repository for Tx_Semantic_Domain_Model_Rdf_Statement
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Repository_Rdf_StatementRepository extends Tx_Extbase_Persistence_Repository {

	public function find($subject = NULL, $predicate = NULL, $object = NULL, $context = NULL) {
		$query = $this->createQuery();
		$constraints = array();
		if ($subject !== NULL) {
			$query->equals('subject', $subject);
		}
		if ($predicate !== NULL) {
			$query->equals('predicate', $predicate);
		}
		if ($object !== NULL) {
			$query->equals('object', $object);
		}
		if ($context !== NULL) {
			$query->equals('context', $context);
		}
		$query->matching($query->logicalAnd($constraints));
		$query->getQuerySettings()->setReturnRawQueryResult(TRUE);
		$statements = $query->execute();
		return $statements;
	}
}
?>