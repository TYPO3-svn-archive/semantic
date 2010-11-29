<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Jochen Rau 
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
 * Controller for the SparqlQuery object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
// TODO: As your extension matures, you should use Tx_Extbase_MVC_Controller_ActionController as base class, instead of the ScaffoldingController used below.
class Tx_Semantic_Controller_SparqlQueryController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_Semantic_Domain_Repository_SparqlQueryRepository
	 */
	protected $sparqlQueryRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->sparqlQueryRepository = t3lib_div::makeInstance('Tx_Semantic_Domain_Repository_SparqlQueryRepository');
	}
	/**
	 * Displays all SparqlQueries
	 */
	public function indexAction() {
		$sparqlQueries = $this->sparqlQueryRepository->findAll();
		$this->view->assign('sparqlQueries', $sparqlQueries);
	}

	/**
	 * Displays a single SparqlQuery
	 *
	 * @param Tx_Semantic_Domain_Model_SparqlQuery $sparqlQuery the SparqlQuery to display
	 */
	public function showAction(Tx_Semantic_Domain_Model_SparqlQuery $sparqlQuery) {
		$this->view->assign('queryResult', $sparqlQuery->execute());
	}

	/**
	 * Displays a form for creating a new SparqlQuery
	 *
	 * @param Tx_Semantic_Domain_Model_SparqlQuery $newSparqlQuery a fresh SparqlQuery object taken as a basis for the rendering
	 * @dontvalidate $newSparqlQuery
	 */
	public function newAction(Tx_Semantic_Domain_Model_SparqlQuery $newSparqlQuery = NULL) {
		$this->view->assign('newSparqlQuery', $newSparqlQuery);
	}

	/**
	 * Creates a new SparqlQuery and forwards to the index action.
	 *
	 * @param Tx_Semantic_Domain_Model_SparqlQuery $newSparqlQuery a fresh SparqlQuery object which has not yet been added to the repository
	 */
	public function createAction(Tx_Semantic_Domain_Model_SparqlQuery $newSparqlQuery) {
		$this->sparqlQueryRepository->add($newSparqlQuery);
		$this->flashMessageContainer->add('Your new SparqlQuery was created.');
		$this->redirect('index');
	}

	/**
	 * Displays a form to edit an existing SparqlQuery
	 *
	 * @param Tx_Semantic_Domain_Model_SparqlQuery $sparqlQuery the SparqlQuery to display
	 * @dontvalidate $sparqlQuery
	 */
	public function editAction(Tx_Semantic_Domain_Model_SparqlQuery $sparqlQuery) {
		$this->view->assign('sparqlQuery', $sparqlQuery);
	}

	/**
	 * Updates an existing SparqlQuery and forwards to the index action afterwards.
	 *
	 * @param Tx_Semantic_Domain_Model_SparqlQuery $sparqlQuery the SparqlQuery to display
	 */
	public function updateAction(Tx_Semantic_Domain_Model_SparqlQuery $sparqlQuery) {
		$this->sparqlQueryRepository->update($sparqlQuery);
		$this->flashMessageContainer->add('Your SparqlQuery was updated.');
		$this->redirect('index');
	}

	/**
	 * Deletes an existing SparqlQuery
	 *
	 * @param Tx_Semantic_Domain_Model_SparqlQuery $sparqlQuery the SparqlQuery to be deleted
	 */
	public function deleteAction(Tx_Semantic_Domain_Model_SparqlQuery $sparqlQuery) {
		$this->sparqlQueryRepository->remove($sparqlQuery);
		$this->flashMessageContainer->add('Your SparqlQuery was removed.');
		$this->redirect('index');
	}
	

	
}
?>