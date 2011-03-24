<?php

########################################################################
# Extension Manager/Repository config file for ext "semantic".
#
# Auto generated 24-03-2011 18:39
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Semantic Web Integration',
	'description' => 'This extension provides components to consume and expose data of/to the Linked Data cloud.',
	'category' => 'plugin',
	'author' => 'Jochen Rau',
	'author_email' => 'jochen.rau@typoplanet.de',
	'author_company' => 'typoplanet',
	'shy' => '',
	'dependencies' => 'extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.1.0',
	'constraints' => array(
		'depends' => array(
			'extbase' => '',
			'fluid' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:70:{s:12:"ext_icon.gif";s:4:"e922";s:17:"ext_localconf.php";s:4:"c82e";s:14:"ext_tables.php";s:4:"47c7";s:14:"ext_tables.sql";s:4:"1daf";s:25:"ext_tables_static+adt.sql";s:4:"917e";s:24:"ext_typoscript_setup.txt";s:4:"3f1d";s:16:"kickstarter.json";s:4:"3027";s:21:"Classes/Exception.php";s:4:"a19b";s:40:"Classes/Controller/ContentController.php";s:4:"fac3";s:38:"Classes/Controller/QueryController.php";s:4:"97cb";s:38:"Classes/Domain/Model/Rdf/Namespace.php";s:4:"f379";s:40:"Classes/Domain/Model/Sparql/Endpoint.php";s:4:"4143";s:37:"Classes/Domain/Model/Sparql/Query.php";s:4:"5b86";s:44:"Classes/Domain/Model/Sparql/QueryFactory.php";s:4:"8648";s:53:"Classes/Domain/Model/Sparql/QueryFactoryInterface.php";s:4:"62c9";s:46:"Classes/Domain/Model/Sparql/QueryInterface.php";s:4:"20d4";s:43:"Classes/Domain/Model/Sparql/QueryResult.php";s:4:"0137";s:48:"Classes/Domain/Model/Sparql/QueryResultCache.php";s:4:"0e81";s:57:"Classes/Domain/Model/Sparql/QueryResultCacheInterface.php";s:4:"777a";s:52:"Classes/Domain/Model/Sparql/QueryResultInterface.php";s:4:"08a7";s:49:"Classes/Domain/Model/Sparql/QueryResultParser.php";s:4:"003e";s:58:"Classes/Domain/Model/Sparql/QueryResultParserInterface.php";s:4:"2525";s:45:"Classes/Domain/Model/Sparql/QuerySettings.php";s:4:"e0fb";s:54:"Classes/Domain/Model/Sparql/QuerySettingsInterface.php";s:4:"a599";s:68:"Classes/Domain/Model/Sparql/Exception/QueryResultParserException.php";s:4:"4067";s:65:"Classes/Domain/Model/Sparql/Exception/SparqlEndpointException.php";s:4:"5db4";s:53:"Classes/Domain/Repository/Rdf/NamespaceRepository.php";s:4:"bb8d";s:55:"Classes/Domain/Repository/Sparql/EndpointRepository.php";s:4:"a7d9";s:52:"Classes/Domain/Repository/Sparql/QueryRepository.php";s:4:"86ec";s:28:"Classes/View/ContentView.php";s:4:"48d6";s:42:"Classes/ViewHelpers/HumanizeViewHelper.php";s:4:"bcff";s:38:"Classes/ViewHelpers/IsOfViewHelper.php";s:4:"ee4e";s:39:"Classes/ViewHelpers/ParseViewHelper.php";s:4:"2196";s:49:"Classes/ViewHelpers/Form/CodeEditorViewHelper.php";s:4:"dee9";s:35:"Configuration/TCA/Rdf/Namespace.php";s:4:"7ce8";s:37:"Configuration/TCA/Sparql/Endpoint.php";s:4:"7527";s:34:"Configuration/TCA/Sparql/Query.php";s:4:"a490";s:41:"Configuration/TCA/Sparql/QueryFactory.php";s:4:"2b78";s:50:"Configuration/TCA/Sparql/QueryFactoryInterface.php";s:4:"102c";s:43:"Configuration/TCA/Sparql/QueryInterface.php";s:4:"10a0";s:40:"Configuration/TCA/Sparql/QueryResult.php";s:4:"f082";s:49:"Configuration/TCA/Sparql/QueryResultInterface.php";s:4:"cfce";s:46:"Configuration/TCA/Sparql/QueryResultMapper.php";s:4:"5e39";s:55:"Configuration/TCA/Sparql/QueryResultMapperInterface.php";s:4:"8882";s:42:"Configuration/TCA/Sparql/QuerySettings.php";s:4:"4810";s:51:"Configuration/TCA/Sparql/QuerySettingsInterface.php";s:4:"5370";s:34:"Configuration/TypoScript/setup.txt";s:4:"7bcb";s:39:"Configuration/TypoScript/RDFa/setup.txt";s:4:"26fd";s:41:"Configuration/TypoScript/Sparql/setup.txt";s:4:"5079";s:27:"Documentation/en/Manual.txt";s:4:"58ae";s:40:"Resources/Private/Language/locallang.xml";s:4:"4f36";s:83:"Resources/Private/Language/locallang_csh_tx_semantic_domain_model_rdf_namespace.xml";s:4:"fddd";s:85:"Resources/Private/Language/locallang_csh_tx_semantic_domain_model_sparql_endpoint.xml";s:4:"a7bf";s:82:"Resources/Private/Language/locallang_csh_tx_semantic_domain_model_sparql_query.xml";s:4:"2797";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"0db1";s:38:"Resources/Private/Layouts/default.html";s:4:"77bb";s:42:"Resources/Private/Partials/formErrors.html";s:4:"f5bc";s:47:"Resources/Private/Templates/Content/Render.html";s:4:"c7c3";s:43:"Resources/Private/Templates/Query/Edit.html";s:4:"7f4a";s:44:"Resources/Private/Templates/Query/Index.html";s:4:"9eb1";s:42:"Resources/Private/Templates/Query/New.html";s:4:"4528";s:43:"Resources/Private/Templates/Query/Show.html";s:4:"adf0";s:37:"Resources/Public/Css/sparqlcolors.css";s:4:"32ca";s:35:"Resources/Public/Icons/relation.gif";s:4:"e615";s:33:"Resources/Public/Icons/sparql.gif";s:4:"4da3";s:59:"Resources/Public/Icons/tx_semantic_domain_model_rdf_iri.gif";s:4:"1103";s:65:"Resources/Public/Icons/tx_semantic_domain_model_rdf_namespace.gif";s:4:"1103";s:67:"Resources/Public/Icons/tx_semantic_domain_model_sparql_endpoint.gif";s:4:"1103";s:64:"Resources/Public/Icons/tx_semantic_domain_model_sparql_query.gif";s:4:"905a";s:56:"Tests/Unit/Domain/Model/Sparql/QueryResultParserTest.php";s:4:"96fb";}',
);

?>