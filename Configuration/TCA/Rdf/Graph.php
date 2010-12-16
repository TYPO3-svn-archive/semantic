<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_semantic_domain_model_rdf_graph'] = array(
	'ctrl' => $TCA['tx_semantic_domain_model_rdf_graph']['ctrl'],
	'interface' => array(
		'showRecordFieldList'	=> 'name,statement'
	),
	'types' => array(
		'1' => array('showitem'	=> 'name,statement')
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
				'foreign_table' => 'tx_semantic_domain_model_rdf_graph',
				'foreign_table_where' => 'AND tx_semantic_domain_model_rdf_graph.uid=###REC_FIELD_l18n_parent### AND tx_semantic_domain_model_rdf_graph.sys_language_uid IN (-1,0)',
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
			'label'		=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_rdf_graph.name',
			'config'	=> array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'statement' => array(
			'exclude'	=> 0,
			'label'		=> 'LLL:EXT:semantic/Resources/Private/Language/locallang_db.xml:tx_semantic_domain_model_rdf_graph.statement',
			'config'	=> array(
				'type' => 'select',
				'foreign_table' => 'tx_semantic_domain_model_rdf_statement',
				'MM' => 'tx_semantic_graph_statement_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
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
							'table'=>'tx_semantic_domain_model_rdf_statement',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			)
		),
	),
);
?>