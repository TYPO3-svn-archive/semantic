<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_semantic_domain_model_sparql_query'] = array(
	'ctrl' => $TCA['tx_semantic_domain_model_sparql_query']['ctrl'],
	'interface' => array(
		'showRecordFieldList'	=> 'name,endpoint,namespaces,body,tx_semantic_limit,offset'
	),
	'types' => array(
		'1' => array('showitem'	=> 'name,endpoint,namespaces,body;;;nowrap,tx_semantic_limit,offset')
	),
	'palettes' => array(
		'1' => array('showitem'	=> '')
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude'			=> 1,
			'label'				=> 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config'			=> array(
				'type'					=> 'select',
				'foreign_table'			=> 'sys_language',
				'foreign_table_where'	=> 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				)
			)
		),
		'l18n_parent' => array(
			'displayCond'	=> 'FIELD:sys_language_uid:>:0',
			'exclude'		=> 1,
			'label'			=> 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config'		=> array(
				'type'			=> 'select',
				'items'			=> array(
					array('', 0),
				),
				'foreign_table' => 'tx_semantic_domain_model_sparql_query',
				'foreign_table_where' => 'AND tx_semantic_domain_model_sparql_query.uid=###REC_FIELD_l18n_parent### AND tx_semantic_domain_model_sparql_query.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config'		=>array(
				'type'		=>'passthrough'
			)
		),
		't3ver_label' => array(
			'displayCond'	=> 'FIELD:t3ver_label:REQ:true',
			'label'			=> 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config'		=> array(
				'type'		=>'none',
				'cols'		=> 27
			)
		),
		'hidden' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'	=> array(
				'type'	=> 'check'
			)
		),
		'name' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_sparql_query.name',
			'config'	=> array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			)
		),
		'body' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_sparql_query.body',
			'config'	=> array(
				'type' => 'text',
				'cols' => 60,
				'rows' => 25,
				'eval' => 'trim',
			)
		),
		'tx_semantic_limit' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_sparql_query.limit',
			'config'	=> array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim,integer'
			)
		),
		'offset' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_sparql_query.offset',
			'config'	=> array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'trim,integer'
			)
		),
		'endpoint' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_sparql_query.endpoint',
			'config'	=> array(
				'type' => 'select',
				'foreign_table' => 'tx_semantic_domain_model_sparql_endpoint',
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
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table'=>'tx_semantic_domain_model_sparql_endpoint',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),
			)
		),
		'namespaces' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_sparql_query.namespaces',
			'config'	=> array(
				'type' => 'select',
				'foreign_table' => 'tx_semantic_domain_model_rdf_namespace',
				'MM' => 'tx_semantic_query_namespace_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'minitems' => 0,
				'maxitems' => 999999,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 0,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table'=>'tx_semantic_domain_model_rdf_namespace',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),
			)
		),
	),
);

if (version_compare(t3lib_extMgm::getExtensionVersion('t3editor'), '1.5.1', '>=')) {
	$TCA['tx_semantic_domain_model_sparql_query']['types']['1']['showitem'] = 'name,endpoint,namespaces,body;;;nowrap:wizards[t3editor],tx_semantic_limit,offset';
	$TCA['tx_semantic_domain_model_sparql_query']['columns']['body']['config']['wizards']['t3editor'] = array(
		'enableByTypeConfig' => 1,
		'type' => 'userFunc',
		'userFunc' => 'EXT:t3editor/classes/class.tx_t3editor_tceforms_wizard.php:tx_t3editor_tceforms_wizard->main',
		'title' => 't3editor',
		'icon' => 'wizard_table.gif',
		'script' => 'wizard_table.php',
		'params' => array(
			'format' => 'sparql',
		),
	);
}

?>