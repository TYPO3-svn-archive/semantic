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
 * Controller for the Graph object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Controller_GraphController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_Semantic_Domain_Repository_Rdf_GraphRepository
	 */
	protected $graphRepository;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->graphRepository = t3lib_div::makeInstance('Tx_Semantic_Domain_Repository_Rdf_GraphRepository');
	}
	

	/**
	 * Displays all Graphs
	 */
	public function indexAction() {
		$graphs = $this->graphRepository->findAll();
		$this->view->assign('graphs', $graphs);
	}

	/**
	 * Displays a single Graph
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Graph $graph the Graph to display
	 */
	public function showAction(Tx_Semantic_Domain_Model_Rdf_Graph $graph) {
		$this->view->assign('graph', $graph);
	}

	/**
	 * Displays a form for creating a new Graph
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Graph $newGraph a fresh Graph object taken as a basis for the rendering
	 * @dontvalidate $newGraph
	 */
	public function newAction(Tx_Semantic_Domain_Model_Rdf_Graph $newGraph = NULL) {
		$this->view->assign('newGraph', $newGraph);
	}

	/**
	 * Creates a new Graph and forwards to the index action.
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Graph $newGraph a fresh Graph object which has not yet been added to the repository
	 */
	public function createAction(Tx_Semantic_Domain_Model_Rdf_Graph $newGraph) {
		$this->graphRepository->add($newGraph);
		$this->flashMessageContainer->add('Your new Graph was created.');
		$this->redirect('index');
	}

	/**
	 * Displays a form to edit an existing Graph
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Graph $graph the Graph to display
	 * @dontvalidate $graph
	 */
	public function editAction(Tx_Semantic_Domain_Model_Rdf_Graph $graph) {
		$this->view->assign('graph', $graph);
	}

	/**
	 * Updates an existing Graph and forwards to the index action afterwards.
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Graph $graph the Graph to display
	 */
	public function updateAction(Tx_Semantic_Domain_Model_Rdf_Graph $graph) {
		$this->graphRepository->update($graph);
		$this->flashMessageContainer->add('Your Graph was updated.');
		$this->redirect('index');
	}

	/**
	 * Deletes an existing Graph
	 *
	 * @param Tx_Semantic_Domain_Model_Rdf_Graph $graph the Graph to be deleted
	 */
	public function deleteAction(Tx_Semantic_Domain_Model_Rdf_Graph $graph) {
		$this->graphRepository->remove($graph);
		$this->flashMessageContainer->add('Your Graph was removed.');
		$this->redirect('index');
	}

}
?>