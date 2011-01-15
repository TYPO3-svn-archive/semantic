<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (!is_array($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['cache_semantic_sparql_queryresult'])) {
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_semantic_sparql_queryresult'] = array(
		'frontend' => 't3lib_cache_frontend_VariableFrontend',
		'backend' => 't3lib_cache_backend_DbBackend',
		'options' => array(
			'cacheTable' => 'tx_semantic_cache_sparql_queryresult',
			'tagsTable' => 'tx_semantic_cache_sparql_queryresult_tags',
		),
	);
}


Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'SparqlQuery',
	array(
		'Query' => 'execute',
	),
	array(
		'Query' => 'execute',
	)
);

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'SparqlAdmin',
	array(
		'Query' => 'index, show, execute, new, create, edit, update, delete',
	),
	array(
		'Query' => 'execute, create, update, delete',
	)
);

?>