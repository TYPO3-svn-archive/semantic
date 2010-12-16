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
 * Controller for the Endpoint object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Controller_EndpointController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_Semantic_Domain_Repository_Sparql_EndpointRepository
	 */
	protected $endpointRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->endpointRepository = t3lib_div::makeInstance('Tx_Semantic_Domain_Repository_Sparql_EndpointRepository');
	}
	

	/**
	 * Displays all Endpoints
	 */
	public function indexAction() {
		$endpoints = $this->endpointRepository->findAll();
		$this->view->assign('endpoints', $endpoints);
	}

	/**
	 * Displays a single Endpoint
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint the Endpoint to display
	 */
	public function showAction(Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint) {
		$this->view->assign('endpoint', $endpoint);
	}

	/**
	 * Displays a form for creating a new Endpoint
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Endpoint $newEndpoint a fresh Endpoint object taken as a basis for the rendering
	 * @dontvalidate $newEndpoint
	 */
	public function newAction(Tx_Semantic_Domain_Model_Sparql_Endpoint $newEndpoint = NULL) {
		$this->view->assign('newEndpoint', $newEndpoint);
	}

	/**
	 * Creates a new Endpoint and forwards to the index action.
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Endpoint $newEndpoint a fresh Endpoint object which has not yet been added to the repository
	 */
	public function createAction(Tx_Semantic_Domain_Model_Sparql_Endpoint $newEndpoint) {
		$this->endpointRepository->add($newEndpoint);
		$this->flashMessageContainer->add('Your new Endpoint was created.');
		$this->redirect('index');
	}

	/**
	 * Displays a form to edit an existing Endpoint
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint the Endpoint to display
	 * @dontvalidate $endpoint
	 */
	public function editAction(Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint) {
		$this->view->assign('endpoint', $endpoint);
	}

	/**
	 * Updates an existing Endpoint and forwards to the index action afterwards.
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint the Endpoint to display
	 */
	public function updateAction(Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint) {
		$this->endpointRepository->update($endpoint);
		$this->flashMessageContainer->add('Your Endpoint was updated.');
		$this->redirect('index');
	}

	/**
	 * Deletes an existing Endpoint
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint the Endpoint to be deleted
	 */
	public function deleteAction(Tx_Semantic_Domain_Model_Sparql_Endpoint $endpoint) {
		$this->endpointRepository->remove($endpoint);
		$this->flashMessageContainer->add('Your Endpoint was removed.');
		$this->redirect('index');
	}

}
?>