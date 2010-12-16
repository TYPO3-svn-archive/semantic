<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'SparqlQuery',
	'Execute a Single SPARQL Query'
);

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'SparqlAdmin',
	'SPARQL Query Admin'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Semantic Web Integration');

$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_sparqlquery'] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_sparqlquery', 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForm/SparqlQuery.xml');


t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_rdf_blanknode', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_rdf_blanknode.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_rdf_blanknode');
$TCA['tx_semantic_domain_model_rdf_blanknode'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_rdf_blanknode',
		'label'						=> 'identifier',
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
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Rdf/BlankNode.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_rdf_blanknode.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_rdf_iri', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_rdf_iri.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_rdf_iri');
$TCA['tx_semantic_domain_model_rdf_iri'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_rdf_iri',
		'label'						=> 'value',
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
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Rdf/Iri.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_rdf_iri.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_rdf_literal', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_rdf_literal.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_rdf_literal');
$TCA['tx_semantic_domain_model_rdf_literal'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_rdf_literal',
		'label'						=> 'value',
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
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Rdf/Literal.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_rdf_literal.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_sparql_endpoint', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_sparql_endpoint.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_sparql_endpoint');
$TCA['tx_semantic_domain_model_sparql_endpoint'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_sparql_endpoint',
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
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Rdf/Namespace.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_rdf_namespace.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_rdf_graph', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_rdf_graph.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_rdf_graph');
$TCA['tx_semantic_domain_model_rdf_graph'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_rdf_graph',
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
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Rdf/Graph.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_rdf_graph.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_rdf_statement', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_rdf_statement.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_rdf_statement');
$TCA['tx_semantic_domain_model_rdf_statement'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_rdf_statement',
		'label'						=> 'subject',
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
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Rdf/Statement.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_rdf_statement.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_rdf_plainliteral', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_rdf_plainliteral.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_rdf_plainliteral');
$TCA['tx_semantic_domain_model_rdf_plainliteral'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_rdf_plainliteral',
		'label'						=> 'language',
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
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Rdf/PlainLiteral.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_rdf_plainliteral.gif'
	)
);

t3lib_extMgm::addLLrefForTCAdescr('tx_semantic_domain_model_rdf_typedliteral', 'EXT:semantic/Resources/Private/Language/locallang_csh_tx_semantic_domain_model_rdf_typedliteral.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_semantic_domain_model_rdf_typedliteral');
$TCA['tx_semantic_domain_model_rdf_typedliteral'] = array(
	'ctrl' => array(
		'title'						=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_rdf_typedliteral',
		'label'						=> 'datatype',
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
		'dynamicConfigFile'			=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Rdf/TypedLiteral.php',
		'iconfile'					=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_semantic_domain_model_rdf_typedliteral.gif'
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