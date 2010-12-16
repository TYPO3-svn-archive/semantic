<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'sparqlclient',
	array(
		'Query' => 'index, show, new, create, edit, update, delete','Endpoint' => 'index, show, new, create, edit, update, delete','Graph' => 'index, show, new, create, edit, update, delete','Statement' => 'index, show, new, create, edit, update, delete',
	),
	array(
		'Endpoint' => 'create, update, delete','Graph' => 'create, update, delete','Statement' => 'create, update, delete','Query' => 'create, update, delete',
	)
);

?>