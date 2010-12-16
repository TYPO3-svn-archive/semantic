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
 * This is a triple of subject, predicate, and object. A context is optional.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_Rdf_Statement extends Tx_Extbase_DomainObject_AbstractEntity {
	
	/**
	 * subject
	 * @var Tx_Semantic_Domain_Model_Rdf_SubjectInterface
	 */
	protected $subject;
	
	/**
	 * predicate
	 * @var Tx_Semantic_Domain_Model_Rdf_PredicateInterface
	 */
	protected $predicate;
	
	/**
	 * object
	 * @var Tx_Semantic_Domain_Model_Rdf_ObjectInterface
	 */
	protected $object;
	
	/**
	 * context
	 * @var Tx_Semantic_Domain_Model_Rdf_Iri
	 */
	protected $context;
	
	/**
	 * Setter for subject
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_SubjectInterface $subject subject
	 * @return void
	 */
	public function setSubject(Tx_Semantic_Domain_Model_Rdf_SubjectInterface $subject) {
		$this->subject = $subject;
	}

	/**
	 * Getter for subject
	 *
	 * @return Tx_Semantic_Domain_Model_Rdf_SubjectInterface subject
	 */
	public function getSubject() {
		return $this->subject;
	}
	
	/**
	 * Setter for predicate
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_PredicateInterface $predicate predicate
	 * @return void
	 */
	public function setPredicate(Tx_Semantic_Domain_Model_Rdf_PredicateInterface $predicate) {
		$this->predicate = $predicate;
	}

	/**
	 * Getter for predicate
	 *
	 * @return Tx_Semantic_Domain_Model_Rdf_PredicateInterface predicate
	 */
	public function getPredicate() {
		return $this->predicate;
	}
	
	/**
	 * Setter for object
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_ObjectInterface $object object
	 * @return void
	 */
	public function setObject(Tx_Semantic_Domain_Model_Rdf_ObjectInterface $object) {
		$this->object = $object;
	}

	/**
	 * Getter for object
	 *
	 * @return Tx_Semantic_Domain_Model_Rdf_ObjectInterface object
	 */
	public function getObject() {
		return $this->object;
	}
	
	/**
	 * Setter for context
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Iri $context context
	 * @return void
	 */
	public function setContext(Tx_Semantic_Domain_Model_Rdf_Iri $context) {
		$this->context = $context;
	}

	/**
	 * Getter for context
	 *
	 * @return Tx_Semantic_Domain_Model_Rdf_Iri context
	 */
	public function getContext() {
		return $this->context;
	}
	
}
?>