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
 * Controller for the Statement object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Controller_StatementController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_Semantic_Domain_Repository_Rdf_StatementRepository
	 */
	protected $statementRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->statementRepository = t3lib_div::makeInstance('Tx_Semantic_Domain_Repository_Rdf_StatementRepository');
	}
	

	/**
	 * Displays all Statements
	 */
	public function indexAction() {
		$statements = $this->statementRepository->findAll();
		$this->view->assign('statements', $statements);
	}

	/**
	 * Displays a single Statement
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Statement $statement the Statement to display
	 */
	public function showAction(Tx_Semantic_Domain_Model_Rdf_Statement $statement) {
		$this->view->assign('statement', $statement);
	}

	/**
	 * Displays a form for creating a new Statement
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Statement $newStatement a fresh Statement object taken as a basis for the rendering
	 * @dontvalidate $newStatement
	 */
	public function newAction(Tx_Semantic_Domain_Model_Rdf_Statement $newStatement = NULL) {
		$this->view->assign('newStatement', $newStatement);
	}

	/**
	 * Creates a new Statement and forwards to the index action.
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Statement $newStatement a fresh Statement object which has not yet been added to the repository
	 */
	public function createAction(Tx_Semantic_Domain_Model_Rdf_Statement $newStatement) {
		$this->statementRepository->add($newStatement);
		$this->flashMessageContainer->add('Your new Statement was created.');
		$this->redirect('index');
	}

	/**
	 * Displays a form to edit an existing Statement
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Statement $statement the Statement to display
	 * @dontvalidate $statement
	 */
	public function editAction(Tx_Semantic_Domain_Model_Rdf_Statement $statement) {
		$this->view->assign('statement', $statement);
	}

	/**
	 * Updates an existing Statement and forwards to the index action afterwards.
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Statement $statement the Statement to display
	 */
	public function updateAction(Tx_Semantic_Domain_Model_Rdf_Statement $statement) {
		$this->statementRepository->update($statement);
		$this->flashMessageContainer->add('Your Statement was updated.');
		$this->redirect('index');
	}

	/**
	 * Deletes an existing Statement
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Statement $statement the Statement to be deleted
	 */
	public function deleteAction(Tx_Semantic_Domain_Model_Rdf_Statement $statement) {
		$this->statementRepository->remove($statement);
		$this->flashMessageContainer->add('Your Statement was removed.');
		$this->redirect('index');
	}

}
?>