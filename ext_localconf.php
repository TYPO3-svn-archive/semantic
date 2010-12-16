<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
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