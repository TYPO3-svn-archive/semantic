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
 * Controller for rendering a SPARQL Query Result
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Controller_ContentController extends Tx_Extbase_MVC_Controller_ActionController {
	
	/**
	 * @var Tx_Semantic_Domain_Repository_Sparql_QueryRepository
	 */
	protected $queryRepository;

	/**
	 * @array The database row of the current content object
	 */
	protected $contentObjectData;

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->queryRepository = t3lib_div::makeInstance('Tx_Semantic_Domain_Repository_Sparql_QueryRepository');
	}

	protected function initializeRenderAction() {
		$contentObjectData = $this->configurationManager->getContentObject()->data;
		$this->settings['query'] = !isset($this->settings['query']) ? intval($contentObjectData['tx_semantic_query']) : intval($this->settings['query']);
		$this->settings['layout'] = !isset($this->settings['layout']) ? $contentObjectData['tx_semantic_layout'] : $this->settings['layout'];
//		$this->settings['templateCode'] = !isset($this->settings['templateCode'])strlen($this->settings['templateCode']) > 0 ? $contentObjectData['bodytext'] : '';
		$this->settings['paginate'] = !isset($this->settings['paginate']) ? (bool)$contentObjectData['tx_semantic_paginate'] : (bool)$this->settings['paginate'];
	}
	
	/**
	 * Renders the content of a Sparql Query Result
	 *
	 * @param Tx_Semantic_Domain_Model_Sparql_Query $query the Sparql Query to be executed and rendered
	 */
	public function renderAction(Tx_Semantic_Domain_Model_Sparql_Query $query = NULL) {
		if ($query === NULL) {
			if (isset($this->settings['query'])) {
				$query = $this->queryRepository->findByUid(intval($this->settings['query']));
			} elseif (isset($this->contentObjectData['tx_semantic_query']) && !empty($this->contentObjectData['tx_semantic_query'])) {
				$query = $this->queryRepository->findByUid(intval($this->contentObjectData['tx_semantic_query']));
			}
			if ($query === NULL) {
				return '';
			}
		}
		$queryResult = $query->execute();
		$this->view->assign('queryResult', $queryResult);
	}

}
?>