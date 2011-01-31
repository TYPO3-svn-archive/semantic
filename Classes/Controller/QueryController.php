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
 * Controller for the Query object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Controller_QueryController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_Semantic_Domain_Repository_Sparql_QueryRepository
	 */
	protected $queryRepository;

	/**
	 * @var Tx_Semantic_Domain_Repository_Sparql_EndpointRepository
	 */
	protected $endpointRepository;

	/**
	 * @var Tx_Semantic_Domain_Repository_Rdf_NamespaceRepository
	 */
	protected $namespaceRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->queryRepository = t3lib_div::makeInstance('Tx_Semantic_Domain_Repository_Sparql_QueryRepository');
		$this->endpointRepository = t3lib_div::makeInstance('Tx_Semantic_Domain_Repository_Sparql_EndpointRepository');
		$this->namespaceRepository = t3lib_div::makeInstance('Tx_Semantic_Domain_Repository_Rdf_NamespaceRepository');
	}
	

	/**
	 * Displays all Queries
	 */
	public function indexAction() {
		$queries = $this->queryRepository->findAll();
		$this->view->assign('queries', $queries);
	}

	/**
	 * Displays a single Query
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Query $query the Query to display
	 */
	public function showAction(Tx_Semantic_Domain_Model_Sparql_Query $query) {
		$this->view->assign('query', $query);
	}

	/**
	 * Executes a SparqlQuery
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Query $query the Sparql Query to display
	 */
	public function executeAction(Tx_Semantic_Domain_Model_Sparql_Query $query = NULL) {
		if ($query === NULL) {
			$query = $this->queryRepository->findByUid($this->settings['query']);
			if ($query === NULL) {
				return '';
			}
		}
		$queryResult = $query->execute();
		$this->view->assign('queryResult', $queryResult);
	}

	/**
	 * Displays a form for creating a new Query
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Query $newQuery a fresh Query object taken as a basis for the rendering
	 * @dontvalidate $newQuery
	 */
	public function newAction(Tx_Semantic_Domain_Model_Sparql_Query $newQuery = NULL) {
		$this->view->assign('newQuery', $newQuery);
		$this->view->assign('endpoints', $this->endpointRepository->findAll());
		$this->view->assign('namespaces', $this->namespaceRepository->findAll());
	}

	/**
	 * Creates a new Query and forwards to the index action.
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Query $newQuery a fresh Query object which has not yet been added to the repository
	 */
	public function createAction(Tx_Semantic_Domain_Model_Sparql_Query $newQuery) {
		$this->queryRepository->add($newQuery);
		$this->flashMessageContainer->add('Your new Query was created.');
		$this->redirect('index');
	}

	/**
	 * Displays a form to edit an existing Query
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Query $query the Query to display
	 * @dontvalidate $query
	 */
	public function editAction(Tx_Semantic_Domain_Model_Sparql_Query $query) {
		$this->view->assign('query', $query);
		$this->view->assign('endpoints', $this->endpointRepository->findAll());
		$this->view->assign('namespaces', $this->namespaceRepository->findAll());
	}

	/**
	 * Updates an existing Query and forwards to the index action afterwards.
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Query $query the Query to display
	 */
	public function updateAction(Tx_Semantic_Domain_Model_Sparql_Query $query) {
		$this->queryRepository->update($query);
		$this->flashMessageContainer->add('Your Query was updated.');
		$this->redirect('index');
	}

	/**
	 * Deletes an existing Query
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Query $query the Query to be deleted
	 */
	public function deleteAction(Tx_Semantic_Domain_Model_Sparql_Query $query) {
		$this->queryRepository->remove($query);
		$this->flashMessageContainer->add('Your Query was removed.');
		$this->redirect('index');
	}

}
?>