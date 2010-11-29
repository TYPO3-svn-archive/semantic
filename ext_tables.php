<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'table',
	'Table View (Semantic Web Integration)'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Semantic Web Integration');

//$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_table'] = 'pi_flexform';
//t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_table', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_table.xml');


t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_sparqlquery', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_sparqlquery.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_sparqlquery');
$TCA['tx_semantic_domain_model_sparqlquery'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_sparqlquery',
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
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/SparqlQuery.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_sparqlquery.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_sparqlendpoint', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_sparqlendpoint.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_sparqlendpoint');
$TCA['tx_semantic_domain_model_sparqlendpoint'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_sparqlendpoint',
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
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/SparqlEndpoint.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_sparqlendpoint.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_namespace', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_namespace.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_namespace');
$TCA['tx_semantic_domain_model_namespace'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_namespace',
		'label'						=> 'prefix',
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
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Namespace.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_namespace.gif'
	)
);

?>