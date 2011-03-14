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
	 * These constants designate how a custom template code is loaded by the controller.
	 * custromroot => The controller expects a root path to the templates.
	 * customfile => The controller loads a single template file.
	 * customcode => The controller takes the bodytext of the content element as template code.
	 */
	const LAYOUT_CUSTOMROOT = 'customroot';
	const LAYOUT_CUSTOMFILE = 'customfile';
	const LAYOUT_CUSTOMCODE = 'customcode';

	/**
	 * The current view, as resolved by resolveView()
	 *
	 * @var Tx_Semantic_View_ContentView
	 * @api
	 */
	protected $view = NULL;

	/**
	 * Pattern after which the view object name is built if no Fluid template
	 * is found.
	 * @var string
	 * @api
	 */
	protected $viewObjectNamePattern = 'Tx_Semantic_View_ContentView';

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
		$contentObjectSettings = array(
			'query' => $contentObjectData['tx_semantic_query'],
			'layout' => $contentObjectData['tx_semantic_layout'],
			'templateCode' => '{namespace s=Tx_Semantic_ViewHelpers}<f:layout name="default"/><f:section name="main">'
					. $contentObjectData['bodytext']
					. '</f:section>',
			'paginate' => $contentObjectData['tx_semantic_paginate']
		);
		$this->settings = t3lib_div::array_merge_recursive_overrule($this->settings, $contentObjectSettings, 0, FALSE);
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
			}
			if ($query === NULL) {
				return '';
			}
		}
		if ($this->settings['layout'] === self::LAYOUT_CUSTOMCODE) {
			$this->view->setTemplateSource($this->settings['templateCode']);
		}
		try {
			$this->view->assign('query', $query->execute());
			$content = $this->view->render(); // The query gets executed lazily during render time. Thus, we include the render() method.
		} catch (Tx_Semantic_Domain_Model_Sparql_Exception_SparqlEndpointException $exception){
			$content = '';
		}
		return $content;
	}

}
?>