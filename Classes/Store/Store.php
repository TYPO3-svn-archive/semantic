<?php
declare(ENCODING = 'utf-8');
namespace T3\Semantic\Store;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Maroschik <tmaroschik@dfau.de>
 *  All rights reserved
 *
 *  This class is a port of the corresponding class of the
 * {@link http://aksw.org/Projects/Erfurt Erfurt} project.
 *  All credits go to the Erfurt team.
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Enter descriptions here
 *
 * @package $PACKAGE$
 * @subpackage $SUBPACKAGE$
 * @scope prototype
 * @entity
 * @api
 */

define('STORE_RESULTFORMAT','result_format');
define('STORE_RESULTFORMAT_PLAIN','plain');
define('STORE_RESULTFORMAT_XML','xml');
define('STORE_RESULTFORMAT_EXTENDED','extended');
define('STORE_USE_AC','use_ac');
define('STORE_USE_OWL_IMPORTS','use_owl_imports');
define('STORE_USE_ADDITIONAL_IMPORTS','use_additional_imports');
define('STORE_TIMEOUT','timeout');
class Store implements \t3lib_Singleton {
	const COUNT_NOT_SUPPORTED = -1;

	/**
	 * Literal type.
	 * @var int
	 */
	const TYPE_LITERAL = 1;

	/**
	 * IRI type.
	 * @var int
	 */
	const TYPE_IRI = 2;

	/**
	 * Balanknode type.
	 * @var int
	 */
	const TYPE_BLANKNODE = 3;

	/**
	 * A proeprty for hiding resources.
	 * @var string
	 */
	const HIDDEN_PROPERTY = 'http://ns.ontowiki.net/SysOnt/hidden';

	/**
	 * The maximum number of iterations for recursive operatiosn.
	 * @var int
	 */
	const MAX_ITERATIONS = 100;

	/**
	 * RDF-S model identifier.
	 * @var int
	 */
	const MODEL_TYPE_RDFS = 501;

	/**
	 * OWL model identifier.
	 * @var int
	 */
	const MODEL_TYPE_OWL = 502;

	/**
	 * Username of the super user who gets unrestricted access
	 * @var string
	 */
	protected $databaseUser;

	/**
	 * Password of the super user who gets unrestricted access
	 * @var string
	 */
	protected $databasePassword;

	/**
	 * An RDF/PHP array containing additional configuration options for graphs
	 * in the triple store. This information is stored in the local system
	 * ontology.
	 * @var array
	 *
	 */
	protected $graphConfigurations;

	/**
	 * Store options
	 * @var array
	 */
	protected $options = array();

	/**
	 * An Array holding the Namespace prefixes (An array of namespace IRIs (keys) and prefixes) for some models
	 * @var array
	 */
	protected $prefixes;

	/**
	 * Special zend logger, which protocolls all queries
	 * Call with function to initialize
	 * @var \Zend_Logger
	 */
	protected $queryLogger;

	/**
	 * Special zend logger, which protocolls erfurt messages
	 * Call with function to initialize
	 * @var \Zend_Logger
	 */
	protected $erfurtLogger;

	/**
	 * Access control instance
	 * @var \Erfurt_Ac_Default
	 */
	protected $accessControl;

	/**
	 * The name of the backend adapter instance in use.
	 * @var string
	 */
	protected $backendName;

	/**
	 * The backend adapter instance in use.
	 * @var \Erfurt_Store_Backend_Adapter_Interface
	 */
	protected $backendAdapter;

	/**
	 * The injected knowledge base
	 *
	 * @var \T3\Semantic\KnowledgeBase
	 */
	protected $knowledgeBase;

	/**
	 * The injected knowledge base
	 *
	 * @var \T3\Semantic\Object\ObjectManager
	 */
	protected $objectManager;

	/**
	 * Optional methods a backend adapter can implement
	 * @var array
	 */
	protected $optionalMethods = array(
		'countWhereMatches'
	);

	/**
	 * Number of queries committed
	 * @var int
	 */
	private static $queryCount = 0;

	// TODO elaborate relevance
	private $importsClosure = array();

	/**
	 * Injector method for a \T3\Semantic\KnowledgeBase
	 *
	 * @var \T3\Semantic\KnowledgeBase
	 */
	public function injectKnowledgeBase(\T3\Semantic\KnowledgeBase $knowledgeBase) {
		$this->knowledgeBase = $knowledgeBase;
	}

	/**
	 * Injector method for a \T3\Semantic\Object|ObjectManager
	 *
	 * @var \T3\Semantic\Object|ObjectManager
	 */
	public function injectObjectManager(\T3\Semantic\Object\ObjectManager $objectManager) {
		$this->objectManager = $objectManager;
	}

	/**
	 * Lifecycle method after all dependencies were injected
	 *
	 * @throws Exception\BackendMustBeSetException
	 * @return void
	 */
	public function initializeObject() {
			$storeConfiguration = $this->knowledgeBase->getStoreConfiguration();
			// Backend must be set, else throw an exception.
			if (isset($storeConfiguration->backend)) {
				$backend = strtolower($storeConfiguration->backend);
			} else {
				throw new Exception\BackendMustBeSetException('Backend must be set in configuration.', 1302769905);
			}
			// Check configured schema and if not set set it as empty (e.g. virtuoso needs no special schema.
			if (isset($storeConfiguration->schema)) {
				$schema = $storeConfiguration->schema;
			} else {
				$schema = NULL;
			}
			// fetch backend specific options from config.
			$backendOptions = array();
			if ($backendConfig = $storeConfiguration->get($backend)) {
				$backendOptions = $backendConfig->toArray();
			}
			// store config options
			if (isset($storeConfiguration->sysont)) {
				$storeOptions = $storeConfiguration->sysont->toArray();
			} else {
				$storeOptions = array();
			}
			$this->initializeBackend($storeOptions, $backend, $backendOptions, $schema);
	}

	/**
	 * Initializes the backend
	 *
	 * @param string $backend virtuoso, mysqli, adodb, redland
	 * @param array $backendOptions
	 * @param string/null $schema rap
	 *
	 * @throws \T3\Semantic\Store\Exception\StoreException if store is not supported or store does not implement the store
	 * adapter interface.
	 */
	public function initializeBackend($storeOptions, $backend, array $backendOptions = array(), $schema = null) {
		while (list($optionName, $optionValue) = each($storeOptions)) {
			$this->setOption($optionName, $optionValue);
		}
		if (isset($storeOptions['adapterInstance'])) {
			$this->backendAdapter = $storeOptions['adapterInstance'];
			$this->backendName = $backend;
			return;
		}
		// store connection settings for super admin id
		if (array_key_exists('username', $backendOptions)) {
			$this->databaseUser = $backendOptions['username'];
		}
		if (array_key_exists('password', $backendOptions)) {
			$this->databasePassword = $backendOptions['password'];
		}
		// build schema name
		$schemaName = $schema ? ucfirst($schema) : '';
		if ($backend === 'zenddb') {
			$this->backendName = 'ZendDb';
			// Use Ef schema as default for the ZendDb backend
			if (null === $schema) {
				$schemaName = 'Ef';
			}
			$className = '\Erfurt_Store_Adapter_'
				 . $schemaName
				 . $this->backendName;
		} elseif ($backend === 'typo3') {
			$this->backendName = 'Typo3';
			$className = '\T3\Semantic\Store\Adapter\\'
				 . $this->backendName;
		} else {
			$this->backendName = ucfirst($backend);
			$className = '\Erfurt_Store_Adapter_'
				 . $schemaName
				 . $this->backendName;
		}
		// check class existence
		if (!class_exists($className)) {
			$msg = "Backend '$this->backendName' "
				   . ($schema ? "with schema '$schemaName'" : "")
				   . " not supported. No suitable backend adapter class found.";
			throw new Exception\StoreException($msg);
		}
		// instantiate backend adapter
		$this->backendAdapter = $this->objectManager->create($className, $backendOptions);
		// check interface conformance
		// but do not check the comparer adapter since we use __call there
		if ($backend != 'comparer') {
			if (!($this->backendAdapter instanceof Adapter\AdapterInterface)) {
				throw new Exception\StoreException('Adapter class must implement Adapter\AdapterInterface.');
			}
		}
	}

	/**
	 * Sets the backend adapter
	 *
	 * @param Adapter\AdapterInterface $adapter
	 */
	public function setBackendAdapter(Adapter\AdapterInterface $adapter) {
		$this->backendAdapter = $adapter;
		$this->backendName = $adapter->getBackendName();
	}

	// ------------------------------------------------------------------------
	// --- Public methods -----------------------------------------------------
	// ------------------------------------------------------------------------

	/**
	 * Adds statements in an array to the graph specified by $graphIri.
	 *
	 * @param string $graphIri
	 * @param array  $statementsArray
	 *
	 * @throws \Erfurt_Exception
	 */
	public function addMultipleStatements($graphUri, array $statementsArray, $useAc = true) {
		// TODO inject logger
		if (defined('_EFDEBUG')) {
			$logger = $this->knowledgeBase->getLog();
			$logger->info('Store: adding multiple statements: ' . print_r($statementsArray, true));
		}
		// check whether model is available
		if (!$this->isModelAvailable($graphUri, $useAc)) {
			throw new Exception\StoreException('Model is not available.');
		}
		// check whether model is editable
		if (!$this->checkAccessControl($graphUri, 'edit', $useAc)) {
			throw new Exception\StoreException('No permissions to edit model.');
		}
		$this->backendAdapter->addMultipleStatements($graphUri, $statementsArray);
		//invalidate deprecated Cache Objects
		$queryCache = $this->knowledgeBase->getQueryCache();
		$queryCache->invalidateWithStatements($graphUri, $statementsArray);
		$event = $this->objectManager->create('\T3\Semantic\Event\Event', 'onAddMultipleStatements');
		$event->graphUri = $graphUri;
		$event->statements = $statementsArray;
		$event->trigger();
		$this->graphConfigurations = null;
	}

	/**
	 * Adds a statement to the graph specified by $modelIri.
	 * @param string $graphUri
	 * @param string $subject (IRI or blank node)
	 * @param string $predicate (IRI, no blank node!)
	 * @param string $object (IRI, blank node or literal)
	 * @param array $options An array containing two keys 'subject_type' and 'object_type'. The value of each is
	 * one of the defined constants of \Erfurt_Store: TYPE_IRI, TYPE_BLANKNODE and TYPE_LITERAL. In addtion to this
	 * two keys the options array can contain two keys 'literal_language' and 'literal_datatype', but only in case
	 * the object of the statement is a literal.
	 *
	 * @throws \Erfurt_Exception Throws an exception if adding of statements fails.
	 */
	public function addStatement($graphUri, $subject, $predicate, $object, $useAcl = true) {
		// check whether model is available
		if ($useAcl && !$this->isModelAvailable($graphUri)) {
			throw new Exception\StoreException('Model is not available.');
		}
		// check whether model is editable
		if ($useAcl && !$this->checkAccessControl($graphUri, 'edit')) {
			throw new Exception\StoreException('No permissions to edit model.');
		}
		$this->backendAdapter->addStatement($graphUri, $subject, $predicate, $object);
		//invalidate deprecateded Cache Objects
		$queryCache = $this->knowledgeBase->getQueryCache();
		$queryCache->invalidate($graphUri, $subject, $predicate, $object);
		$event = $this->objectManager->create('\T3\Semantic\Event\Event', 'onAddStatement');
		$event->graphUri = $graphUri;
		$event->statement = array(
			'subject' => $subject,
			'predicate' => $predicate,
			'object' => $object
		);
		$event->trigger();
		$this->graphConfigurations = null;
	}

	/**
	 * Checks whether the store has been set up yet and imports system
	 * ontologies if necessary.
	 */
	public function checkSetup() {
//		$logger = $this->knowledgeBase->getLog();
		$sysOntSchema = $this->getOption('schemaUri');
		$schemaLocation = $this->getOption('schemaLocation');
		$schemaPath = preg_replace('/[\/\\\\]/', '/', EF_BASE . $this->getOption('schemaPath'));
		$sysOntModel = $this->getOption('modelUri');
		$modelLocation = $this->getOption('modelLocation');
		$modelPath = preg_replace('/[\/\\\\]/', '/', EF_BASE . $this->getOption('modelPath'));
		$returnValue = true;
		// check for system configuration model
		// We need to import this first, for the schema model has namespaces definitions, which will be stored in the
		// local config!
		if (!$this->isModelAvailable($sysOntModel, false)) {
//			$logger->info('System configuration model not found. Loading model ...');
			$this->knowledgeBase->getVersioning()->enableVersioning(false);
			$this->getNewModel($sysOntModel, '', 'owl', false);
			try {
				if (is_readable($modelPath)) {
					// load SysOnt Model from file
					$this->importRdf($sysOntModel, $modelPath, 'rdfxml',
									 \Erfurt_Syntax_RdfParser::LOCATOR_FILE, false);
				} else {
					// load SysOnt Model from Web
					$this->importRdf($sysOntModel, $modelLocation, 'rdfxml',
									 \Erfurt_Syntax_RdfParser::LOCATOR_URL, false);
				}
			}
			catch (\Erfurt_Exception $e) {
				// clear query cache completly
				$queryCache = $this->knowledgeBase->getQueryCache();
				$queryCache->cleanUpCache(array('mode' => 'uninstall'));
				// Delete the model, for the import failed.
				$this->backendAdapter->deleteModel($sysOntModel);
				throw new Exception\StoreException("Import of '$sysOntModel' failed -> " . $e->getMessage());
			}
			if (!$this->isModelAvailable($sysOntModel, false)) {
				throw new Exception\StoreException('Unable to load System Ontology model.');
			}
			$this->knowledgeBase->getVersioning()->enableVersioning(true);
//			$logger->info('System model successfully loaded.');
			$returnValue = false;
		}
		// check for system ontology
		if (!$this->isModelAvailable($sysOntSchema, false)) {
//			$logger->info('System schema model not found. Loading model ...');
			$this->knowledgeBase->getVersioning()->enableVersioning(false);
			$this->getNewModel($sysOntSchema, '', 'owl', false);
			try {
				if (is_readable($schemaPath)) {
					// load SysOnt from file
					$this->importRdf($sysOntSchema, $schemaPath, 'rdfxml', \Erfurt_Syntax_RdfParser::LOCATOR_FILE,
									 false);
				} else {
					// load SysOnt from Web
					$this->importRdf($sysOntSchema, $schemaLocation, 'rdfxml', \Erfurt_Syntax_RdfParser::LOCATOR_URL,
									 false);
				}
			}
			catch (\Erfurt_Exception $e) {
				// clear query cache completly
				$queryCache = $this->knowledgeBase->getQueryCache();
				$queryCache->cleanUpCache(array('mode' => 'uninstall'));
				// Delete the model, for the import failed.
				$this->backendAdapter->deleteModel($sysOntSchema);
				throw new Exception\StoreException("Import of '$sysOntSchema' failed -> " . $e->getMessage());
			}
			if (!$this->isModelAvailable($sysOntSchema, false)) {
				throw new Exception\StoreException('Unable to load System Ontology schema.');
			}
			$this->knowledgeBase->getVersioning()->enableVersioning(true);
//			$logger->info('System schema successfully loaded.');
			$returnValue = false;
		}
		if ($returnValue === false) {
			throw new Exception\StoreException('One or more system models imported.', 20);
		}
		return true;
	}


	/**
	 * Creates the table specified by $tableSpec according to backend-specific
	 * create table statement.
	 *
	 * @param array $tableSpec An associative array of SQL column names and columnd specs.
	 */
	public function createTable($tableName, array $columns) {
		if ($this->backendAdapter instanceof \Erfurt_Store_Sql_Interface) {
			return $this->backendAdapter->createTable($tableName, $columns);
		}
		// TODO: use default SQL store
	}

	/**
	 * Deletes all statements that match the triple pattern specified.
	 *
	 * @param string $modelIri
	 * @param mixed triple pattern $subject (string or null)
	 * @param mixed triple pattern $predicate (string or null)
	 * @param mixed triple pattern $object (string or null)
	 * @param array $options An array containing two keys 'subject_type' and 'object_type'. The value of each is
	 * one of the defined constants of \Erfurt_Store: TYPE_IRI, TYPE_BLANKNODE and TYPE_LITERAL. In addtion to this
	 * two keys the options array can contain two keys 'literal_language' and 'literal_datatype'.
	 *
	 * @throws \Erfurt_Exception
	 */
	public function deleteMatchingStatements($graphUri, $subject, $predicate, $object, $options = array()) {
		if (!isset($options['use_ac'])) {
			$options['use_ac'] = true;
		}
		if ($this->checkAccessControl($graphUri, 'edit', $options['use_ac'])) {
			try {
				$ret = $this->backendAdapter->deleteMatchingStatements(
					$graphUri, $subject, $predicate, $object, $options);
				$queryCache = $this->knowledgeBase->getQueryCache();
				$queryCache->invalidate($graphUri, $subject, $predicate, $object);
				$event = $this->objectManager->create('\T3\Semantic\Event\Event', 'onDeleteMatchingStatements');
				$event->graphUri = $graphUri;
				$event->resource = $subject;
				// just trigger if really data operations were performed
				if ((int)$ret > 0) {
					$event->trigger();
				}
				return $ret;
			}
			catch (\Erfurt_Store_Adapter_Exception $e) {
				// TODO: Create a exception for too many matching values
				// In this case we log without storing the payload. No rollback supported for such actions.
				$event = $this->objectManager->create('\T3\Semantic\Event\Event', 'onDeleteMatchingStatements');
				$event->graphUri = $graphUri;
				$event->resource = $subject;
				\Erfurt_Event_Dispatcher::getInstance()->trigger($event);
			}
		}
	}

	/**
	 * Deletes statements in an array from the graph specified by $graphIri.
	 *
	 * @param string $graphIri
	 * @param array  $statementsArray
	 *
	 * @throws \Erfurt_Exception
	 */
	public function deleteMultipleStatements($graphUri, array $statementsArray) {
		// check whether model is available
		if (!$this->isModelAvailable($graphUri)) {
			throw new Exception\StoreException('Model is not available.');
		}
		// check whether model is editable
		if (!$this->checkAccessControl($graphUri, 'edit')) {
			throw new Exception\StoreException('No permissions to edit model.');
		}
		$this->backendAdapter->deleteMultipleStatements($graphUri, $statementsArray);
		$queryCache = $this->knowledgeBase->getQueryCache();
		$queryCache->invalidateWithStatements($graphUri, $statementsArray);
		$event = $this->objectManager->create('\T3\Semantic\Event\Event', 'onDeleteMultipleStatements');
		$event->graphUri = $graphUri;
		$event->statements = $statementsArray;
		$event->trigger();
	}

	/**
	 * @param string $modelIri The Iri, which identifies the model.
	 * @param boolean $useAc Whether to use access control or not.
	 *
	 * @throws \Erfurt_Exception Throws an exception if no permission, model not existing or deletion fails.
	 */
	public function deleteModel($modelIri, $useAc = true) {
		// check whether model is available
		if (!$this->isModelAvailable($modelIri, $useAc)) {
			throw new Exception\StoreException("Model <$modelIri> is not available and therefore not removable.");
		}
		// check whether model editing is allowed
		if (!$this->checkAccessControl($modelIri, 'edit', $useAc)) {
			throw new Exception\StoreException("No permissions to delete model <$modelIri>.");
		}
		// delete model
		$this->backendAdapter->deleteModel($modelIri);
		// and history
		$this->knowledgeBase->getVersioning()->deleteHistoryForModel($modelIri);
		$queryCache = $this->knowledgeBase->getQueryCache();
		$queryCache->invalidateWithModelIri($modelIri);
		// remove any statements about deleted model from SysOnt
		if ($this->knowledgeBase->getAcModel() !== false) {
			$acModelIri = $this->knowledgeBase->getAcModel()->getModelIri();
			// Only do that, if the deleted model was not one of the sys models
			if (($modelIri !== $this->getOption('modelUri')) && ($modelIri !== $this->getOption('schemaUri'))) {
				$this->backendAdapter->deleteMatchingStatements(
					$acModelIri,
					null,
					null,
					array('value' => $modelIri, 'type' => 'uri')
				);
				$this->backendAdapter->deleteMatchingStatements(
					$acModelIri,
					$modelIri,
					null,
					null
				);
				// invalidate for the sysmodel too
				$queryCache->invalidateWithModelIri($acModelIri);
			}
		}
	}

	/**
	 *
	 * @param string $modelIri
	 * @param string $serializationType One of:
	 *										  - 'xml'
	 *										  - 'n3' or 'nt'
	 * @param mixed $filename Either a string containing a absolute filename or null. In case null is given,
	 * this method returns a string containing the serialization.
	 *
	 * @return string/null
	 */
	public function exportRdf($modelIri, $serializationType = 'xml', $filename = null) {
		$serializationType = strtolower($serializationType);
		// check whether model is available
		if (!$this->isModelAvailable($modelIri)) {
			throw new Exception\StoreException("Model <$modelIri> cannot be exported. Model is not available.");
		}
		if (in_array($serializationType, $this->backendAdapter->getSupportedExportFormats())) {
			return $this->backendAdapter->exportRdf($modelIri, $serializationType, $filename);
		} else {
			$serializer = \Erfurt_Syntax_RdfSerializer::rdfSerializerWithFormat($serializationType);
			return $serializer->serializeGraphToString($modelIri);
		}
	}

	/**
	 * Searches resources that have literal property values matching $stringSpec.
	 *
	 * @param string $stringSpec The string pattern to be matched
	 * @param string|array $graphUris One or more graph URIs to be searched
	 * @param array option array
	 */
	public function getSearchPattern($stringSpec, $graphUris, $options = array()) {
		// TODO stringSpec should be more than simple string (parse for and/or/xor etc...)
		$stringSpec = (string)$stringSpec;
		$options = array_merge(array(
									'case_sensitive' => false,
									'filter_classes' => false,
									'filter_properties' => false,
									'with_imports' => true
							   ), $options);
		// execute backend-specific search if available
		if (method_exists($this->backendAdapter, 'getSearchPattern')) {
			return $this->backendAdapter->getSearchPattern($stringSpec, $graphUris, $options);
		}
			// else execute Sparql Regex Fallback
		else {
			$ret = array();
			$s_var = $this->objectManager->create('\T3\Semantic\Sparql\Query2\Variable', 'resourceUri');
			$p_var = $this->objectManager->create('\T3\Semantic\Sparql\Query2\Variable', 'p');
			$o_var = $this->objectManager->create('\T3\Semantic\Sparql\Query2\Variable', 'o');
			$default_tpattern = $this->objectManager->create('\T3\Semantic\Sparql\Query2\Triple', $s_var, $p_var, $o_var);
			$ret[] = $default_tpattern;
			$filter = $this->objectManager->create('\T3\Semantic\Sparql\Query2\Filter',
				$this->objectManager->create('\T3\Semantic\Sparql\Query2\ConditionalOrExpression',
					array(
						 /*new \T3\Semantic\Sparql\Query2\Regex(
													 $s_var,
													 new \T3\Semantic\Sparql\Query2\RDFLiteral($stringSpec),
													 $options['case_sensitive'] ? null : new \T3\Semantic\Sparql\Query2\RDFLiteral('i')
												 ),*/
						 $this->objectManager->create('\T3\Semantic\Sparql\Query2\Regex',
							 $o_var,
							 $this->objectManager->create('\T3\Semantic\Sparql\Query2\RDFLiteral', $stringSpec),
							 $options['case_sensitive'] ? null : $this->objectManager->create('\T3\Semantic\Sparql\Query2\RDFLiteral', 'i')
						 )
					)
				)
			);
			if ($options['filter_properties']) {
				$ss_var = $this->objectManager->create('\T3\Semantic\Sparql\Query2\Variable', 'ss');
				$oo_var = $this->objectManager->create('\T3\Semantic\Sparql\Query2\Variable', 'oo');
				$filterprop_tpattern = $this->objectManager->create('\T3\Semantic\Sparql\Query2\Triple', $ss_var, $s_var, $oo_var);
				$ret[] = $filterprop_tpattern;
				/*
								$filter->getConstraint()->addElement(
									new \T3\Semantic\Sparql\Query2\Regex(
											$oo_var,
											new \T3\Semantic\Sparql\Query2\RDFLiteral($stringSpec),
											$options['case_sensitive'] ? null : new \T3\Semantic\Sparql\Query2\RDFLiteral('i')
										)
								);*/
			}
			$ret[] = $filter;
			return $ret;
		}
	}

	/**
	 * @param boolean $withHidden Whether to return URIs of hidden graphs, too.
	 * @return array Returns an associative array, where the key is the URI of a graph and the value
	 * is true.
	 */
	public function getAvailableModels($withHidden = false) {
		// backend adapter returns all models
		$models = $this->backendAdapter->getAvailableModels();
		// filter for access control and hidden models
		foreach ($models as $graphUri => $true) {
			if (!$this->checkAccessControl($graphUri)) {
				unset($models[$graphUri]);
			}
			if ($withHidden === false) {
				$graphConfig = $this->getGraphConfiguration($graphUri);
				$hiddenProperty = $this->getOption('propertiesHidden');
				if (isset($graphConfig[$hiddenProperty])) {
					$hidden = current($graphConfig[$hiddenProperty]);
					if ((boolean)$hidden['value']) {
						unset($models[$graphUri]);
					}
				}
			}
		}
		return $models;
	}

	/**
	 * Returns the db connection username
	 *
	 * @return string
	 */
	public function getDbUser() {
		return $this->databaseUser;
	}

	/**
	 * Returns the db connection password
	 *
	 * @return string
	 */
	public function getDbPassword() {
		return $this->databasePassword;
	}

	public function getImportsClosure($modelIri, $withHiddenImports = true, $useAC = true) {
		if (array_key_exists($modelIri, $this->importsClosure)) {
			return $this->importsClosure[$modelIri];
		}
		if ($this->backendName == "Virtuoso") {
			$objectCache = $this->knowledgeBase->getCache();
			$importsClosure = null;
			$importsClosureKey = "ImportsClosure_" . (md5($modelIri));
			$importsClosure = $objectCache->load($importsClosureKey);
			if (is_array($importsClosure)) {
				//nothing ToDo
			} else {
				$queryCache = $this->knowledgeBase->getQueryCache();
				$queryCache->startTransaction($importsClosureKey);
				$importsClosure = $this->_getImportsClosure($modelIri, $withHiddenImports, $useAC);
				$queryCache->endTransaction($importsClosureKey);
				$objectCache->save($importsClosure, $importsClosureKey);
			}
		} else {
			$importsClosure = $this->_getImportsClosure($modelIri, $withHiddenImports, $useAC);
		}
		$this->importsClosure[$modelIri] = $importsClosure;
		return $importsClosure;
	}


	/**
	 * Recursively gets owl:imported model IRIs starting with $modelIri as root.
	 *
	 * @param string $modelIri
	 */
	private function _getImportsClosure($modelIri, $withHiddenImports = true, $useAC = true) {
		$currentLevel = $this->backendAdapter->getImportsClosure($modelIri);
		if ($currentLevel == array($modelIri)) {
			return $currentLevel;
		}
		if ($withHiddenImports === true) {
			$importsUri = $this->getOption('propertiesHiddenImports');
			$graphConfig = $this->getGraphConfiguration($modelIri);
			if (isset($graphConfig[$importsUri])) {
				foreach ($graphConfig[$importsUri] as $valueArray) {
					$currentLevel[$valueArray['value']] = $valueArray['value'];
				}
			}
			foreach ($currentLevel as $graphUri) {
				$graphConfig = $this->getGraphConfiguration($graphUri);
				if (isset($graphConfig[$importsUri])) {
					foreach ($graphConfig[$importsUri] as $valueArray) {
						$currentLevel = array_merge(
							$currentLevel,
							$this->getImportsClosure($valueArray['value'], $withHiddenImports)
						);
					}
				}
			}
		}
		return array_unique($currentLevel);
	}

	/**
	 * @param string $modelIri The IRI, which identifies the model.
	 * @param boolean $useAc Whether to use access control or not.
	 * @throws \T3\Semantic\Store\Exception\StoreException if the requested model is not available.
	 * @return \Erfurt_Rdf_Model Returns an instance of \Erfurt_Rdf_Model or one of its subclasses.
	 */
	public function getModel($modelIri, $useAc = true) {
		// check whether model exists and is visible
		if (!$this->isModelAvailable($modelIri, $useAc)) {
			$systemModelUri = $this->getOption('modelUri');
			$systemSchemaUri = $this->getOption('schemaUri');
			// check whether requested model is one of the schema models
			if (!$useAc && (($modelIri === $systemModelUri) || ($modelIri === $systemSchemaUri))) {
				try {
					$this->checkSetup();
				}
				catch (Exception\StoreException $e) {
					if ($e->getCode() === 20) {
						// Everything is fine, system models now imported
					} else {
						throw new Exception\StoreException('Check setup failed: ' . $e->getMessage());
					}
				}
				// still not available?
				if (!$this->isModelAvailable($modelIri, $useAc)) {
					throw new Exception\StoreException("Model '$modelIri' is not available.");
				}
			} else {
				throw new Exception\StoreException("Model '$modelIri' is not available.");
			}
		}
		// if backend adapter provides its own implementation
		if (method_exists($this->backendAdapter, 'getModel')) {
			// … use it
			$modelInstance = $this->backendAdapter->getModel($modelIri);
		} else {
			// use generic implementation
			$owlQuery = $this->objectManager->create('\T3\Semantic\Sparql\SimpleQuery');
			$owlQuery->setProloguePart('ASK')
					->addFrom($modelIri)
					->setWherePart('{<' . $modelIri . '> <' . EF_RDF_NS . 'type> <' . EF_OWL_ONTOLOGY . '>.}');
			// TODO: cache this
			if ($this->sparqlAsk($owlQuery, $useAc)) {
				// instantiate OWL model
				$modelInstance = $this->objectManager->create('\T3\Semantic\Owl\Model', $modelIri);
			} else {
				// instantiate RDF-S model
				$modelInstance = $this->objectManager->create('\T3\Semantic\Rdfs\Model', $modelIri);
			}
		}
		// check for edit possibility
		if ($this->checkAccessControl($modelIri, 'edit', $useAc)) {
			$modelInstance->setEditable(true);
		} else {
			$modelInstance->setEditable(false);
		}
		return $modelInstance;
	}

	/**
	 * Returns the number fo queries committed.
	 *
	 * @return int
	 */
	public function getQueryCount() {
		return self::$queryCount;
	}

	/**
	 * Creates a new empty model instance with IRI $modelIri.
	 *
	 * @param string $modelIri
	 * @param string $baseIri
	 * @param string $type
	 * @param boolean $useAc
	 *
	 * @throws \T3\Semantic\Store\Exception\StoreException
	 *
	 * @return \Erfurt_Rdf_Model
	 */
	public function getNewModel($modelIri, $baseIri = '', $type = self::MODEL_TYPE_OWL, $useAc = true) {
		// check model availablity
		if ($this->isModelAvailable($modelIri, false)) {
			// if debug mode is enabled create a more detailed exception description. If debug mode is disabled the
			// user should not know why this fails.
			$message = defined('_EFDEBUG')
					? 'Failed creating the model. Reason: A model with the same URI already exists.'
					: 'Failed creating the model.';
			throw new Exception\StoreException($message);
		}
		// check action access
		if ($useAc && !$this->knowledgeBase->isActionAllowed('ModelManagement')) {
			throw new Exception\StoreException("Failed creating the model. Action not allowed!");
		}
		try {
			$this->backendAdapter->createModel($modelIri, $type);
		}
		catch (\Erfurt_Store_Adapter_Exception $e) {
			$message = defined('_EFDEBUG')
					? "Failed creating the model. \nReason: {$e->getMessage()}."
					: 'Failed creating the model.';
			throw new Exception\StoreException($message);
		}
		// everything ok, create new model
		// no access control since we have already checked
		return $this->getModel($modelIri, $useAc);
	}

	/**
	 * Returns inferred objects in realation to a certain set of resources.
	 *
	 * Returned objects are related to objects in the closure of start resources.
	 * Said closure is calculated using hte closure property. If no closure
	 * property is specified, the object property is used instead.
	 *
	 * @todo Implement generic version and call backend implementation if applicable.
	 */
	public function getObjectsInferred($modelUri, $startResources, $objectProperty, $closureProperty = null) {
	}

	/**
	 * Returns a specified config option.
	 *
	 * @param string $optionName
	 * @return string
	 */
	public function getOption($optionName) {
		if (isset($this->options[$optionName])) {
			return $this->options[$optionName];
		}
		return null;
	}

	/**
	 * Returns an array of serialization formats that can be exported.
	 *
	 * @return array
	 */
	public function getSupportedExportFormats() {
		$supportedFormats = array(
			'rdfxml' => 'RDF/XML',
			'ttl' => 'Turtle',
			'rdfjson' => 'RDF/JSON (Talis)'
		);
		return array_merge($supportedFormats, $this->backendAdapter->getSupportedExportFormats());
	}

	/**
	 * Returns an array of serialization formats that can be imported.
	 *
	 * @return array
	 */
	public function getSupportedImportFormats() {
		$supportedFormats = array(
			'rdfxml' => 'RDF/XML',
			'rdfjson' => 'RDF/JSON (Talis)',
			'ttl' => 'Turtle'
		);
		return array_merge($supportedFormats, $this->backendAdapter->getSupportedImportFormats());
	}

	/**
	 *
	 * @param string $modelIri
	 * @param string $locator Either a URL or a absolute file name.
	 * @param string $type One of:
	 *							  - 'auto' => Tries to detect the type automatically in the following order:
	 *											  1. Detect XML by XML-Header => rdf/xml
	 *											  2. If this fails use the extension of the file
	 *											  3. If this fails throw an exception
	 *							  - 'xml'
	 *							  - 'n3' or 'nt'
	 * @param string $locator Denotes whether $data is a local file or a URL.
	 *
	 * @throws \Erfurt_Exception
	 */
	public function importRdf($modelIri, $data, $type = 'auto', $locator = \Erfurt_Syntax_RdfParser::LOCATOR_FILE,
		$useAc = true) {
		$queryCache = $this->knowledgeBase->getQueryCache();
		$queryCache->invalidateWithModelIri($modelIri);
		if (!$this->checkAccessControl($modelIri, 'edit', $useAc)) {
			throw new Exception\StoreException("Import failed. Model <$modelIri> not found or not writable.");
		}
		if ($type === 'auto') {
			// detect file type
			if ($locator === \Erfurt_Syntax_RdfParser::LOCATOR_FILE && is_readable($data)) {
				$pathInfo = pathinfo($data);
				$type = array_key_exists('extension', $pathInfo) ? $pathInfo['extension'] : '';
			}
			if ($locator === \Erfurt_Syntax_RdfParser::LOCATOR_URL) {
				$headers['Location'] = true;
				// set default content-type header
				stream_context_get_default(array(
												'http' => array(
													'header' => 'Accept: application/rdf+xml, application/json, text/rdf+n3, text/plain',
													'max_redirects' => 1 // no redirects as we need the 303 URI
												)));
				do { // follow redirects
					$flag = false;
					$isRedirect = false;
					$headers = @get_headers($data, 1);
					if (is_array($headers)) {
						$http = $headers[0];
						if (false !== strpos($http, '303')) {
							$data = (string)$headers['Location'];
							$isRedirect = true;
						}
					}
				} while ($isRedirect);
				// restore default empty headers
				stream_context_get_default(array(
												'http' => array(
													'header' => ""
												)));
				if (is_array($headers) && array_key_exists('Content-Type', $headers)) {
					$ct = $headers['Content-Type'];
					if (is_array($ct)) {
						$ct = array_pop($ct);
					}
					$ct = strtolower($ct);
					if (substr($ct, 0, strlen('application/rdf+xml')) === 'application/rdf+xml') {
						$type = 'rdfxml';
						$flag = true;
					} else {
						if (substr($ct, 0, strlen('text/plain')) === 'text/plain') {
							$type = 'rdfxml';
							$flag = true;
						} else {
							if (substr($ct, 0, strlen('text/rdf+n3')) === 'text/rdf+n3') {
								$type = 'ttl';
								$flag = true;
							} else {
								if (substr($ct, 0, strlen('application/json')) === 'application/json') {
									$type = 'rdfjson';
									$flag = true;
								} else {
									// RDF/XML is default
									$type = 'rdfxml';
									$flag = true;
								}
							}
						}
					}
				}
				// try file name
				if (!$flag) {
					switch (strtolower(strrchr($data, '.'))) {
						case '.rdf':
							$type = 'rdfxml';
							break;
						case '.n3':
							$type = 'ttl';
							break;
					}
				}
			}
		}
		if (array_key_exists($type, $this->backendAdapter->getSupportedImportFormats())) {
			$result = $this->backendAdapter->importRdf($modelIri, $data, $type, $locator);
			$this->backendAdapter->init();
			return $result;
		} else {
			$parser = \Erfurt_Syntax_RdfParser::rdfParserWithFormat($type);
			$retVal = $parser->parseToStore($data, $locator, $modelIri, $useAc);
			// After import re-initialize the backend (e.g. zenddb: fetch model infos again)
			$this->backendAdapter->init();
			return $retVal;
		}
	}

	/**
	 * @param string $modelIri The Iri, which identifies the model to look for.
	 * @param boolean $useAc Whether to use access control or not.
	 *
	 * @return boolean Returns true if model exists and is available for the user ($useAc === true).
	 */
	public function isModelAvailable($modelIri, $useAc = true) {
		if ($this->backendAdapter->isModelAvailable($modelIri) && $this->checkAccessControl($modelIri, 'view', $useAc)) {
			return true;
		}
		return false;
	}

	public function isSqlSupported() {
		return ($this->backendAdapter instanceof \Erfurt_Store_Sql_Interface);
	}

	/**
	 * Returns the ID for the last insert statement.
	 */
	public function lastInsertId() {
		if ($this->backendAdapter instanceof \Erfurt_Store_Sql_Interface) {
			return $this->backendAdapter->lastInsertId();
		}
		// TODO: use default SQL store
	}

	/**
	 * Returns an array of SQL tables available in the store.
	 *
	 * @param string $prefix An optional table prefix to filter table names.
	 *
	 * @return array|null
	 */
	public function listTables($prefix = '') {
		if ($this->backendAdapter instanceof \Erfurt_Store_Sql_Interface) {
			return $this->backendAdapter->listTables($prefix);
		}
		// TODO: use default SQL store
	}

	/**
	 * Sets store options.
	 *
	 * @param string $optionName
	 * @param string|array $optionValue
	 */
	public function setOption($optionName, $optionValue) {
		if (is_string($optionValue)) {
			$this->options[$optionName] = $optionValue;
		} else {
			if (is_array($optionValue)) {
				while (list($subName, $subValue) = each($optionValue)) {
					$subOptionName = $optionName
									 . ucfirst($subName);
					$this->setOption($subOptionName, $subValue);
				}
			}
		}
	}

	/**
	 * Executes a SPARQL ASK query and returns a boolean result value.
	 *
	 * @param string $modelIri
	 * @param string $askSparql
	 * @param boolean $useAc Whether to check for access control.
	 */
	public function sparqlAsk(\Erfurt_Sparql_SimpleQuery $queryObject, $useAc = true) {
		// add owl:imports
		foreach ($queryObject->getFrom() as $fromGraphUri) {
			foreach ($this->getImportsClosure($fromGraphUri, true, $useAc) as $importedGraphUri) {
				$queryObject->addFrom($importedGraphUri);
			}
		}
		if ($useAc) {
			$modelsFiltered = $this->filterModels($queryObject->getFrom());
			// query contained a non-allowed non-existent model
			if (empty($modelsFiltered)) {
				return;
				// throw new Exception\StoreException('Query could not be executed.');
			}
			$queryObject->setFrom($modelsFiltered);
			// from named only if it was set
			$fromNamed = $queryObject->getFromNamed();
			if (count($fromNamed)) {
				$queryObject->setFromNamed($this->filterModels($fromNamed));
			}
		}
		$queryCache = $this->knowledgeBase->getQueryCache();
		$sparqlResult = $queryCache->load((string)$queryObject, 'plain');
		if ($sparqlResult == \Erfurt_Cache_Frontend_QueryCache::ERFURT_CACHE_NO_HIT) {
			// TODO: check if adapter supports requested result format
			$startTime = microtime(true);
			$sparqlResult = $this->backendAdapter->sparqlAsk((string)$queryObject);
			self::$queryCount++;
			$duration = microtime(true) - $startTime;
			$queryCache->save((string)$queryObject, 'plain', $sparqlResult, $duration);
		}
		return $sparqlResult;
	}

	/**
	 * @param \Erfurt_Sparql_SimpleQuery $queryObject
	 * @param string $resultFormat Currently supported are: 'plain' and 'xml'
	 * @param boolean $useAc Whether to check for access control or not.
	 *
	 * @throws \Erfurt_Exception Throws an exception if query is no string.
	 *
	 * @return mixed Returns a result depending on the query, e.g. an array or a boolean value.
	 */
	public function sparqlQuery($queryObject, $options = array()) {
		// if ($queryObject instanceof \T3\Semantic\Sparql\Query2)
		//     $this->knowledgeBase->getLog()->info('Store: evaluating a Query2-object (sparql:'."\n".$queryObject.') ');
		$defaultOptions = array(
			STORE_RESULTFORMAT => STORE_RESULTFORMAT_PLAIN,
			STORE_USE_AC => true,
			STORE_USE_OWL_IMPORTS => true,
			STORE_USE_ADDITIONAL_IMPORTS => true
		);
		$options = array_merge($defaultOptions, $options);
		$noBindings = false;
		//typechecking
		if (is_string($queryObject)) {
			$queryObject = \T3\Semantic\Sparql\SimpleQuery::initWithString($queryObject);
		}
		if (!($queryObject instanceof \T3\Semantic\Sparql\Query2 || $queryObject instanceof \T3\Semantic\Sparql\SimpleQuery)) {
			throw new \Exception("Argument 1 passed to " . get_class($this) . '::sparqlQuery must be instance of \T3\Semantic\Sparql\Query2, \T3\Semantic\Sparql\SimpleQuery or string', 1303224590);
		}
		/*
				 * clone the Query2 Object to not modify the original one
				 * could be used elsewhere, could have side-effects
				 */
		if ($queryObject instanceof \T3\Semantic\Sparql\Query2) { //always clone?
			$queryObject = clone $queryObject;
		}
		//get all models
		$all = array();
		$allpre = $this->backendAdapter->getAvailableModels(); //really all (without ac)
		foreach ($allpre as $key => $true) {
			$all[] = array('uri' => $key, 'named' => false);
		}
		//get available models (readable)
		$available = array();
		if ($options[STORE_USE_AC] === true) {
			$availablepre = $this->getAvailableModels(true);
			foreach ($availablepre as $key => $true) {
				$available[] = array('uri' => $key, 'named' => false);
			}
		} else {
			$available = $all;
		}
		// examine froms (for access control and imports) in 5 steps
		// 1. extract froms for easier handling
		$froms = array();
		if ($queryObject instanceof \T3\Semantic\Sparql\Query2) {
			foreach ($queryObject->getFroms() as $graphClause) {
				$uri = $graphClause->getGraphIri()->getIri();
				$froms[] = array('uri' => $uri, 'named' => $graphClause->isNamed());
			}
		} else { //SimpleQuery
			foreach ($queryObject->getFrom() as $graphClause) {
				$froms[] = array('uri' => $graphClause, 'named' => false);
			}
			foreach ($queryObject->getFromNamed() as $graphClause) {
				$froms[] = array('uri' => $graphClause, 'named' => true);
			}
		}
		// 2. no froms in query -> froms = availableModels
		if (empty($froms)) {
			$froms = $available;
		}
		// 3. filter froms by availability and existence - if filtering deletes all -> give empty result back
		if ($options[STORE_USE_AC] === true) {
			$froms = $this->maskModelList($froms, $available);
			if (empty($froms)) {
				$noBindings = true;
			}
		}
		// 4. get import closure for every remaining from
		if ($options[STORE_USE_OWL_IMPORTS] === true) {
			foreach ($froms as $from) {
				$importsClosure = $this->getImportsClosure($from['uri'], $options[STORE_USE_ADDITIONAL_IMPORTS], $options[STORE_USE_AC]);
				foreach ($importsClosure as $importedGraphUri) {
					$addCandidate = array('uri' => $importedGraphUri, 'named' => false);
					if (in_array($addCandidate, $available) && array_search($addCandidate, $froms) === false) {
						$froms[] = $addCandidate;
					}
				}
			}
		}
		// 5. put froms back
		if ($queryObject instanceof \T3\Semantic\Sparql\Query2) {
			$queryObject->setFroms(array());
			foreach ($froms as $from) {
				$queryObject->addFrom($from['uri'], $from['named']);
			}
		} else {
			$queryObject->setFrom(array());
			$queryObject->setFromNamed(array());
			foreach ($froms as $from) {
				if (!$from['named']) {
					$queryObject->addFrom($from['uri']);
				} else {
					$queryObject->addFromNamed($from['uri']);
				}
			}
		}
		// if there were froms and all got deleted due to access controll - give back empty result set
		// this is achieved by replacing the where-part with an unsatisfiable one
		// i think this is efficient because otherwise we would have to deal with result formating und variables
		if ($noBindings) {
			if ($queryObject instanceof \T3\Semantic\Sparql\SimpleQuery) {
				$queryObject->setWherePart('{FILTER(false)}');
			} else {
				if ($queryObject instanceof \T3\Semantic\Sparql\Query2) {
					$ggp = $this->objectManager->create('\T3\Semantic\Sparql\Query2GroupGraphPattern');
					$ggp->addFilter(false); //unsatisfiable
					$queryObject->setWhere($ggp);
				}
			}
		}
		//querying SparqlEngine or retrieving Result from QueryCache
		//TODO for query cache, please refactor
		$resultFormat = $options[STORE_RESULTFORMAT];
		$queryCache = $this->knowledgeBase->getQueryCache();
		$sparqlResult = $queryCache->load((string)$queryObject, $resultFormat);
		if ($sparqlResult == \Erfurt_Cache_Frontend_QueryCache::ERFURT_CACHE_NO_HIT) {
			// TODO: check if adapter supports requested result format
			$startTime = microtime(true);
			$sparqlResult = $this->backendAdapter->sparqlQuery($queryObject, $options);
			self::$queryCount++;
			$duration = microtime(true) - $startTime;
			if (defined('_EFDEBUG')) {
				$logger = $this->getQueryLogger();
				if ($duration > 1) {
					$slow = " WARNING SLOW ";
				} else {
					$slow = "";
				}
				$logger->debug("SPARQL *****************" . round((1000 * $duration), 2) . " msec " . $slow . "\n" . $queryObject);
			}
			$queryCache->save((string)$queryObject, $resultFormat, $sparqlResult, $duration);
		}
		return $sparqlResult;
	}

	/**
	 * Executes a SQL query with a SQL-capable backend.
	 *
	 * @param string $sqlQuery A string containing the SQL query to be executed.
	 * @throws \T3\Semantic\Store\Exception\StoreException
	 * @return array
	 */
	public function sqlQuery($sqlQuery, $limit = PHP_INT_MAX, $offset = 0) {
		if ($this->backendAdapter instanceof Sql\SqlInterface) {
			$startTime = microtime(true);
			$result = $this->backendAdapter->sqlQuery($sqlQuery, $limit, $offset);
			$duration = microtime(true) - $startTime;
			if (defined('_EFDEBUG')) {
				$logger = $this->getQueryLogger();
				$logger->debug("SQL ***************** " . round((1000 * $duration), 2) . " msec \n" . $sqlQuery);
			}
			return $result;
		}
		// TODO: will throw an exception
		// throw new Exception\StoreException('Current backend doesn not support SQL queries.');
	}

	/**
	 * Get the configuration for a graph.
	 * @param string $graphUri to specity the graph
	 * @return array
	 */
	public function getGraphConfiguration($graphUri) {
		if (null === $this->graphConfigurations) {
			$sysOntModelUri = $this->getOption('modelUri');
			// Fetch the graph configurations
			$queryObject = $this->objectManager->create('\T3\Semantic\Sparql\SimpleQuery');
			$queryObject->setProloguePart('SELECT ?s ?p ?o');
			$queryObject->setFrom(array($sysOntModelUri));
			$queryObject->setWherePart('WHERE { ?s ?p ?o . ?s a <http://ns.ontowiki.net/SysOnt/Model> }');
			$queryoptions = array(
				'use_ac' => false,
				'result_format' => 'extended',
				'use_additional_imports' => false
			);
			$stmtArray = array();
			if ($result = $this->sparqlQuery($queryObject, $queryoptions)) {
				foreach ($result['bindings'] as $row) {
					if (!isset($stmtArray[$row['s']['value']])) {
						$stmtArray[$row['s']['value']] = array();
					}
					if (!isset($stmtArray[$row['s']['value']][$row['p']['value']])) {
						$stmtArray[$row['s']['value']][$row['p']['value']] = array();
					}
					if ($row['o']['type'] === 'typed-literal') {
						$row['o']['type'] = 'literal';
					}
					if (isset($row['o']['xml:lang'])) {
						$row['o']['lang'] = $row['o']['xml:lang'];
						unset($row['o']['xml:lang']);
					}
					$stmtArray[$row['s']['value']][$row['p']['value']][] = $row['o'];
				}
			}
			$this->graphConfigurations = $stmtArray;
		}
		if (isset($this->graphConfigurations[$graphUri])) {
			return $this->graphConfigurations[$graphUri];
		}
		return array();
	}

	// ------------------------------------------------------------------------
	// --- Optional Methods ---------------------------------------------------
	// ------------------------------------------------------------------------

	/**
	 * Counts all statements that match the SPARQL graph pattern $whereSpec.
	 *
	 * @param string $graphUri
	 * @param string $whereSpec
	 */
	public function countWhereMatches($graphIri, $whereSpec, $countSpec, $distinct = false) {
		// unify parameters
		if (trim($countSpec[0]) !== '?') {
			// TODO: support $
			$countSpec = '?' . $countSpec;
		}
		if (method_exists($this->backendAdapter, 'countWhereMatches')) {
			if ($this->isModelAvailable($graphIri)) {
				$graphIris = array_merge($this->getImportsClosure($graphIri), array($graphIri));
				return $this->backendAdapter->countWhereMatches($graphIris, $whereSpec, $countSpec, $distinct);
			} else {
				throw new Exception\StoreException('Model <' . $graphIri . '> is not available.');
			}
		} else {
			throw new Exception\StoreException('Count is not supported by backend.');
		}
	}

	/**
	 * Returns the class name of the currently used backend.
	 *
	 * @return string
	 */
	public function getBackendName() {
		if (method_exists($this->backendAdapter, 'getBackendName')) {
			return $this->backendAdapter->getBackendName();
		}
		return $this->backendName;
	}

	/**
	 * Returns a list of graph URIs, where each graph in the list contains at least
	 * one statement where the given resource URI is used as a subject.
	 *
	 * @param string $resourceUri
	 * @return array
	 */
	public function getGraphsUsingResource($resourceUri, $useAc = true) {
		if (method_exists($this->backendAdapter, 'getGraphsUsingResource')) {
			$backendResult = $this->backendAdapter->getGraphsUsingResource($resourceUri);
			if ($useAc) {
				$realResult = array();
				foreach ($backendResult as $graphUri) {
					if ($this->isModelAvailable($graphUri, $useAc)) {
						$realResult[] = $graphUri;
					}
				}
				return $realResult;
			} else {
				return $backendResult;
			}
		}
		$query = $this->objectManager->create('\T3\Semantic\Sparql\SimpleQuery');
		$query->setProloguePart('SELECT DISTINCT ?graph')
				->setWherePart('WHERE {GRAPH ?graph {<' . $resourceUri . '> ?p ?o.}}');
		$graphResult = array();
		$result = $this->sparqlQuery($query, array('use_ac' => $useAc));
		if ($result) {
			foreach ($result as $row) {
				$graphResult[] = $row['graph'];
			}
		}
		return $graphResult;
	}

	/**
	 * Returns a logo URL.
	 *
	 * @return string
	 */
	public function getLogoUri() {
		if (method_exists($this->backendAdapter, 'getLogoUri')) {
			return $this->backendAdapter->getLogoUri();
		}
	}

	/**
	 * Calculates the transitive closure for a given property and a set of starting nodes.
	 *
	 * The inverse mode (which is enabled by default) can be used to calculate the
	 * rdfs:subClassOf closure of a set of starting classes.
	 * By default this method uses a private SPARQL implementation to actually query and
	 * calculate the closure. Adapters can (and should!) provide their own implementation.
	 *
	 * @param string $propertyIri The property's IRI for which hte closure should be calculated
	 * @param array $startResources An array of resources as starting nodes
	 * @param boolean $inverse Denotes whether the property is inverse, i.e. ?child ?property ?parent
	 * @param int $maxDepth The maximum number of iteration steps
	 */
	public function getTransitiveClosure($modelIri, $property, $startResources, $inverse = true, $maxDepth = self::MAX_ITERATIONS) {
		if (method_exists($this->backendAdapter, 'getTransitiveClosure')) {
			$closure = $this->backendAdapter->getTransitiveClosure($modelIri, $property, (array)$startResources, $inverse, $maxDepth);
		} else {
			$closure = $this->_getTransitiveClosure($modelIri, $property, (array)$startResources, $inverse, $maxDepth);
		}
		return $closure;
	}

	// ------------------------------------------------------------------------
	// --- Protected Methods --------------------------------------------------
	// ------------------------------------------------------------------------

	/**
	 * Checks whether 'view' or 'edit' are allowed on a certain model. The additional $useAc param
	 * makes it easy to disable access control for internal usage.
	 *
	 * @param string $modelIri The Iri, which identifies the model.
	 * @param string $accessType Supported access types are 'view' and 'edit'.
	 * @param boolean $useAc Whether to use access control or not.
	 *
	 * @return boolean Returns whether view as the case may be edit is allowed for the model or not.
	 */
	private function checkAccessControl($modelIri, $accessType = 'view', $useAc = true) {
		// check whether ac should be used (e.g. ac engine itself needs access to store without ac)
		if ($useAc === false) {
			$logger = $this->getErfurtLogger();
			$logger->warn("Store.php->_checkAc: Doing something without Access Controll!!!");
			$logger->debug("Store.php->_checkAc: ModelIri: " . $modelIri . " accessType: " . $accessType);
			return true;
		} else {
			if ($this->accessControl === null) {
				$this->accessControl = $this->knowledgeBase->getAccessControl();
			}
			return $this->accessControl->isModelAllowed($accessType, $modelIri);
		}
	}

	/**
	 * Filters a list of model IRIs according to ACL constraints of the current agent.
	 *
	 * @param array $modelIris
	 */
	private function filterModels(array $modelIris) {
		$allowedModels = array();
		foreach ($this->getAvailableModels(true) as $key => $true) {
			$allowedModels[] = $key;
		}
		return array_intersect($modelIris, $allowedModels);
	}


	/**
	 * This function is nearly like _filterModels, but you specify the mask and
	 * the list parameter is an 2D-Array of the format:
	 * array(
	 *	 array('uri' => 'http://the.model.uri/1', 'names' => boolean),
	 *	 array('uri' => 'http://the.model.uri/2', 'names' => boolean),
	 *	 ...
	 * )
	 * while in _filterModels the list is a plain list of uris.
	 * We need this function because array_intersect doesn't work on 2D-Arrays.
	 * @param array $list a 2D-Array where the uris are available with $list[<index>]['uri']
	 * @param array $maskIn the mask to apply on the list of the same format as the list
	 * @return array the list witout uri missing in $maskIn
	 */
	private function maskModelList(array $list, array $maskIn = null) {
		$mask = array();
		if ($maskIn === null) {
			foreach ($this->getAvailableModels(true) as $key => $true) {
				$mask[] = $key;
			}
		} else {
			$countMaskIn = count($maskIn);
			for ($i = 0; $i < $countMaskIn; ++$i) {
				$mask[] = $maskIn[$i]['uri'];
			}
		}
		$countList = count($list);
		for ($i = 0; $i < $countList; ++$i) {
			if (array_search($list[$i]['uri'], $mask) === false) {
				// TODO: check if this maybe skips indices ...
				unset($list[$i]);
			}
		}
		return $list;
	}


	/**
	 * Calculates the transitive closure for a given property and a set of starting nodes.
	 *
	 * @see getTransitiveClosure
	 */
	private function _getTransitiveClosure($modelIri, $property, $startResources, $inverse, $maxDepth) {
		$closure = array();
		$classes = $startResources;
		$i = 0;
		$from = '';
		foreach ($this->getImportsClosure($modelIri) as $import) {
			$from .= 'FROM <' . $import . '>' . PHP_EOL;
		}
		while (++$i <= $maxDepth) {
			$where = $inverse ? '?child <' . $property . '> ?parent.' : '?parent <' . $property . '> ?child.';
			$subSparql = 'SELECT ?parent ?child
                FROM <' . $modelIri . '>' . PHP_EOL . $from . '
                WHERE {
                    ' . $where . ' OPTIONAL {?child <http://ns.ontowiki.net/SysOnt/order> ?order}
                    FILTER (
                        sameTerm(?parent, <' . implode('>) || sameTerm(?parent, <', $classes) . '>)
                    )
                }
                ORDER BY ASC(?order)';
			$subSparql = \Erfurt_Sparql_SimpleQuery::initWithString($subSparql);
			// get sub items
			$result = $this->backendAdapter->sparqlQuery($subSparql, array(STORE_RESULTFORMAT => STORE_RESULTFORMAT_PLAIN));
			// break on first empty result
			if (empty($result)) {
				break;
			}
			$classes = array();
			foreach ($result as $row) {
				// $key = $inverse ? $row['child'] : $row['parent'];
				$key = $inverse ? $row['child'] : $row['parent'];
				$closure[$key] = array(
					'node' => $inverse ? $row['child'] : $row['parent'],
					'parent' => $inverse ? $row['parent'] : $row['child'],
					'depth' => $i
				);
				$classes[] = $row['child'];
			}
		}
		// prepare start resources inclusion
		$merger = array();
		foreach ($startResources as $startUri) {
			$merger[(string)$startUri] = array(
				'node' => $startUri,
				'parent' => null,
				'depth' => 0
			);
		}
		// merge in start resources
		$closure = array_merge($merger, $closure);
		return $closure;
	}

	/**
	 * Returns the query logger, lazy initialization
	 *
	 * @return object Zend Logger, which writes to logs/queries.log
	 */
	protected function getQueryLogger() {
		if (null === $this->queryLogger) {
			$this->queryLogger = $this->knowledgeBase->getLog('queries');
		}
		return $this->queryLogger;
	}

	/**
	 * Returns the erfurt logger, lazy initialization
	 *
	 * @return object Zend Logger, which writes to logs/erfurt.log
	 */
	protected function getErfurtLogger() {
		if (null === $this->erfurtLogger) {
			$this->erfurtLogger = $this->knowledgeBase->getLog('erfurt');
		}
		return $this->erfurtLogger;
	}

}

?>