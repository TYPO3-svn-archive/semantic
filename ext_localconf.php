<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (!is_array($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_semantic_sparql_queryresult'])) {
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_semantic_sparql_queryresult'] = array(
		'frontend' => 't3lib_cache_frontend_StringFrontend',
		'backend' => 't3lib_cache_backend_DbBackend',
		'options' => array(
			'cacheTable' => 'tx_semantic_cache_sparql_queryresult',
			'tagsTable' => 'tx_semantic_cache_sparql_queryresult_tags',
		),
	);
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'SparqlContent',
	array('Content' => 'render'),
	array(),
	Tx_Extbase_Utility_Extension::PLUGIN_TYPE_CONTENT_ELEMENT
);

$pluginSignature = strtolower(str_replace(' ', '', ucwords(str_replace('_', ' ', $_EXTKEY)))) . '_sparqlcontent';
t3lib_extMgm::addPageTSConfig('
mod.wizards.newContentElement.wizardItems.special {
    elements.' . $pluginSignature . ' {
		icon = ' . t3lib_extMgm::extRelPath('semantic') . '/Resources/Public/Icons/sparql.gif
		title = Semantic Web Content
		description = The result of a SPARQL Query.
		tt_content_defValues {
			CType = ' . $pluginSignature . '
		}
    }
    show := addToList(' . $pluginSignature . ')
}');

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'SparqlAdmin',
	array(
		'Query' => 'index, show, render, new, create, edit, update, delete',
		'Content' => 'render'
	),
	array(
		'Query' => 'create, update, delete'
	)
);

$TYPO3_CONF_VARS['FE']['eID_include']['store'] = 'EXT:semantic/Tests/Unit/Statement/StoreTest.php';

?>
