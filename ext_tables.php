<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE == 'BE') {
	// register the cache in BE so it will be cleared with "clear all caches"
	try {
		t3lib_cache::initializeCachingFramework();
			// Reflection cache
		$GLOBALS['typo3CacheFactory']->create(
			'cache_semantic_sparql_queryresult',
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_semantic_sparql_queryresult']['frontend'],
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_semantic_sparql_queryresult']['backend'],
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_semantic_sparql_queryresult']['options']
		);
	} catch(t3lib_cache_exception_NoSuchCache $exception) {

	}
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'SparqlContent',
	'Semantic Web Content'
);

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'SparqlAdmin',
	'SPARQL Query Admin'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Basic Settings');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/Rdfa', 'RDFa');
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/Sparql', 'SPARQL Client');

// Add a field  "exclude this page from parsing" to the table "pages" and "tt_content"
$tempColumns = array(
	'tx_semantic_query' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_query',
		'config' => array(
			'type' => 'select',
			'foreign_table' => 'tx_semantic_domain_model_sparql_query',
			'minitems' => 0,
			'maxitems' => 1,
			'suppress_icons' => 1,
			'wizards' => array(
				'_PADDING' => 1,
				'_VERTICAL' => 0,
				'edit' => array(
					'type' => 'popup',
					'title' => 'Edit',
					'script' => 'wizard_edit.php',
					'icon' => 'edit2.gif',
					'popup_onlyOpenIfSelected' => 1,
					'JSopenParams' => 'height=800,width=700,status=0,menubar=0,scrollbars=1',
				),
				'add' => Array(
					'type' => 'script',
					'title' => 'Create new',
					'icon' => 'add.gif',
					'params' => array(
						'table' => 'tx_semantic_domain_model_sparql_query',
						'pid' => '###CURRENT_PID###',
						'setValue' => 'prepend'
					),
					'script' => 'wizard_add.php',
				),
			),
		)
	),
	'tx_semantic_layout' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_layout',
		'config' => array(
			'type' => 'select',
			'items' => array(
				array('LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_layout.raw', 'raw'),
				array('LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_layout.plainlist', 'plainlist'),
				array('LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_layout.plaintable', 'plaintable'),
				array('LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_layout.contenttable', 'contenttable'),
//				array('LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_layout.customroot', 'customroot'),
//				array('LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_layout.customfile', 'customfile'),
				array('LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_layout.customcode', 'customcode'),
			),
			'default' => 'contenttable'
		)
	),
	'tx_semantic_customfile' => array(
		'exclude' => 1,
		'l10n_mode' => 'mergeIfNotBlank',
		'label' => 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_customfile',
		'config' => array(
			'type' => 'input',
			'size' => 40,
		)
	),
	'tx_semantic_paginate' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_paginate',
		'config' => array(
			'type' => 'check',
			'default' => 1
		)
	),
);
t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content', $tempColumns, 1);

$TCA['tt_content']['ctrl']['requestUpdate'] .= ',tx_semantic_layout';
$TCA['tt_content']['types']['semantic_sparqlcontent'] = array(
	'showitem' => 'CType;;4;button;1-1-1, header;;3;;2-2-2, tx_semantic_query;;;;1-1-1, tx_semantic_layout, tx_semantic_paginate',
	'subtype_value_field' => 'tx_semantic_layout',
	'subtypes_addlist' => array(
		'customroot' => 'tx_semantic_customfile;LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_customroot',
		'customfile' => 'tx_semantic_customfile;LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.tx_semantic_customfile',
	),
);

if (version_compare(t3lib_extMgm::getExtensionVersion('t3editor'), '1.5.0', '>=')) {
	$TCA['tt_content']['types']['semantic_sparqlcontent']['subtypes_addlist']['customcode'] = 'bodytext;LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.bodytext;;nowrap:wizards[t3editor]';
} else {
	$TCA['tt_content']['types']['semantic_sparqlcontent']['subtypes_addlist']['customcode'] = 'bodytext;LLL:EXT:semantic/Resources/Private/Language/locallang_db.php:tt_content.bodytext;;nowrap';
}

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_sparql_endpoint', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_sparql_endpoint.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_sparql_endpoint');
$TCA['tx_semantic_domain_model_sparql_endpoint'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_sparql_endpoint',
		'label'						=> 'name',
		'label_alt'                 => 'iri',
		'label_alt_force'           => TRUE,
		'languageField'				=> 'sys_language_uid',
		'transOrigPointerField'		=> 'l18n_parent',
		'transOrigDiffSourceField'	=> 'l18n_diffsource',
		'delete'					=> 'deleted',
		'enablecolumns'				=> array(
			'disabled'		=> 'hidden'
		),
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Sparql/Endpoint.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_sparql_endpoint.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_rdf_namespace', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_rdf_namespace.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_rdf_namespace');
$TCA['tx_semantic_domain_model_rdf_namespace'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_rdf_namespace',
		'label'						=> 'prefix',
		'label_alt'                 => 'iri',
		'label_alt_force'           => TRUE,
		'rootLevel'                 => 1,
		'delete'					=> 'deleted',
		'enablecolumns'				=> array(
			'disabled'		=> 'hidden'
		),
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Rdf/Namespace.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_rdf_namespace.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_sparql_query', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_sparql_query.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_sparql_query');
$TCA['tx_semantic_domain_model_sparql_query'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_sparql_query',
		'label'						=> 'name',
		'tstamp'					=> 'tstamp',
		'crdate'					=> 'crdate',
		'versioningWS'				=> 2,
		'versioning_followPages'	=> TRUE,
		'origUid'					=> 't3_origuid',
		'languageField'				=> 'sys_language_uid',
		'transOrigPointerField'		=> 'l18n_parent',
		'transOrigDiffSourceField'	=> 'l18n_diffsource',
		'delete'					=> 'deleted',
		'enablecolumns'				=> array(
			'disabled'		=> 'hidden'
		),
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Sparql/Query.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_sparql_query.gif'
	)
);

?>