<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'table',
	array(
		'SparqlQuery' => 'index, show, new, create, edit, update, delete',
	),
	array(
		'SparqlQuery' => 'create, update, delete',
	)
);

?>