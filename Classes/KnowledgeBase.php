<?php
declare(ENCODING = 'utf-8') ;
namespace T3\Semantic;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Maroschik <tmaroschik@dfau.de>
 *  All rights reserved
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
 * This is an alternative entry point to the erfurt library
 *
 * @package Semantic
 * @scope singleton
 * @api
 */
class KnowledgeBase implements \t3lib_Singleton {
	/**
	 * Constant that contains the minimum required php version.
	 * @var string
	 */
	const EF_MIN_PHP_VERSION = '5.2.0';

	/**
	 * Constant that contains the minimum required zend framework version.
	 * @var string
	 */
	const EF_MIN_ZEND_VERSION = '1.5.0';

	// ------------------------------------------------------------------------
	// --- protected properties -------------------------------------------------
	// ------------------------------------------------------------------------

	/**
	 * Contains an instance of the Erfurt access control class.
	 * @var ErfurtaccessControl_Default
	 */
	protected $accessControl = NULL;

	/**
	 * Contains an instanciated access control model.
	 * @var Erfurt_Rdf_Model
	 */
	protected $accessControlModel = NULL;

	/**
	 * Contains a reference to Zendauthentication singleton.
	 */
	protected $authentication = NULL;

	/**
	 * Contains the cache object.
	 * @var Zendcache_Core
	 */
	protected $cache = NULL;

	/**
	 * Contains the cache backend.
	 * @var Zendcache_Backend
	 */
	protected $cacheBackend = NULL;

	/**
	 * Contains an instance of the configuration object.
	 * @var \Zend_Config
	 */
	protected $configuration = NULL;

	/**
	 * @var \T3\Semantic\Configuration\AccessControlConfiguration
	 */
	protected $accessControlConfiguration;

	/**
	 * @var \T3\Semantic\Configuration\AuthenticationConfiguration
	 */
	protected $authenticationConfiguration;

	/**
	 * @var \T3\Semantic\Configuration\CacheConfiguration
	 */
	protected $cacheConfiguration;

	/**
	 * @var \T3\Semantic\Configuration\NamespacesConfiguration
	 */
	protected $namespacesConfiguration;

	/**
	 * @var \T3\Semantic\Configuration\SessionConfiguration
	 */
	protected $sessionConfiguration;

	/**
	 * @var \T3\Semantic\Configuration\StoreConfiguration
	 */
	protected $storeConfiguration;

	/**
	 * @var \T3\Semantic\Configuration\SystemOntologyConfiguration
	 */
	protected $systemOntologyConfiguration;

	/**
	 * @var \T3\Semantic\Configuration\UriConfiguration
	 */
	protected $uriConfiguration;

	/**
	 * The injected knowledge base
	 *
	 * @var \T3\Semantic\Object\ObjectManager
	 */
	protected $objectManager;

	/**
	 * Namespace management module
	 * @var Erfurt_Namespaces
	 */
	protected $namespaces = NULL;

	/**
	 * Contains the query cache object.
	 * @var Erfurtcache_Frontend_QueryCache
	 */
	protected $queryCache = NULL;

	/**
	 * Contains the query cache backend.
	 * @var Erfurtcache_Backend_QueryCache_Backend
	 */
	protected $queryCacheBackend = NULL;

	/**
	 * Contains an instance of the store.
	 * @var Erfurt_Store
	 */
	protected $store = NULL;

	/**
	 * Contains an instanciated system ontology model.
	 * @var Erfurt_Rdf_Model
	 */
	protected $systemOntologyModel = NULL;

	/**
	 * Contains an instance of the Erfurt versioning class.
	 *
	 * @var Erfurt_Versioning
	 */
	protected $versioning = NULL;

	/**
	 * Override Erfurt App constructor
	 */
	public function __construct() {
	}

	/**
	 * Injector method for a AccessControlConfiguration
	 *
	 * @var \T3\Semantic\Configuration\AccessControlConfiguration
	 */
	public function injectAccessControlConfiguration(Configuration\AccessControlConfiguration $accessControlConfiguration) {
		$this->accessControlConfiguration = $accessControlConfiguration;
	}

	/**
	 * Injector method for a AuthenticationConfiguration
	 *
	 * @var \T3\Semantic\Configuration\AuthenticationConfiguration
	 */
	public function injectAuthenticationConfiguration(Configuration\AuthenticationConfiguration $authenticationConfiguration) {
		$this->authenticationConfiguration = $authenticationConfiguration;
	}

	/**
	 * Injector method for a CacheConfiguration
	 *
	 * @var \T3\Semantic\Configuration\CacheConfiguration
	 */
	public function injectCacheConfiguration(Configuration\CacheConfiguration $cacheConfiguration) {
		$this->cacheConfiguration = $cacheConfiguration;
	}

	/**
	 * Injector method for a NamespacesConfiguration
	 *
	 * @var \T3\Semantic\Configuration\NamespacesConfiguration
	 */
	public function injectNamespacesConfiguration(Configuration\NamespacesConfiguration $namespacesConfiguration) {
		$this->namespacesConfiguration = $namespacesConfiguration;
	}

	/**
	 * Injector method for a SessionConfiguration
	 *
	 * @var \T3\Semantic\Configuration\SessionConfiguration
	 */
	public function injectSessionConfiguration(Configuration\SessionConfiguration $sessionConfiguration) {
		$this->sessionConfiguration = $sessionConfiguration;
	}

	/**
	 * Injector method for a StoreConfiguration
	 *
	 * @var \T3\Semantic\Configuration\StoreConfiguration
	 */
	public function injectStoreConfiguration(Configuration\StoreConfiguration $storeConfiguration) {
		$this->storeConfiguration = $storeConfiguration;
	}

	/**
	 * Injector method for a SystemOntologyConfiguration
	 *
	 * @var \T3\Semantic\Configuration\SystemOntologyConfiguration
	 */
	public function injectSystemOntologyConfiguration(Configuration\SystemOntologyConfiguration $systemOntologyConfiguration) {
		$this->systemOntologyConfiguration = $systemOntologyConfiguration;
	}

	/**
	 * Injector method for a UriConfiguration
	 *
	 * @var \T3\Semantic\Configuration\UriConfiguration
	 */
	public function injectUriConfiguration(Configuration\UriConfiguration $uriConfiguration) {
		$this->uriConfiguration = $uriConfiguration;
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
	 * Injector method for a \T3\Semantic\Store\Store
	 *
	 * @var \T3\Semantic\Store\Store
	 */
	public function injectStore(\T3\Semantic\Store\Store $store) {
		$this->store = $store;
	}

	/**
	 * Starts the application, which initializes it.
	 *
	 * @param Zendconfiguration|NULL $config An optional config object that will be merged with
	 * the Erfurt config.
	 *
	 * @return \Erfurt_App
	 * @throws \Erfurt_Exception Throws an exception if the connection to the backend server fails.
	 */
	protected function initializeObject() {
		// Check for debug mode.
		$configuration = $this->getConfiguration();
		// Set the configured time zone.
		if (isset($configuration->timezone) && ((boolean)$configuration->timezone !== false)) {
			date_default_timezone_set($configuration->timezone);
		} else {
			date_default_timezone_set('Europe/Berlin');
		}
		// Starting Versioning
		try {
			$versioning = $this->getVersioning();
			if ((boolean)$configuration->versioning === false) {
				$versioning->enableVersioning(false);
			}
		}
		catch (\Erfurt_Exception $e) {
			throw new \Erfurt_Exception($e->getMessage());
		}
		return $this;
	}

	/**
	 * Adds a new OpenID user to the store.
	 *
	 * @param string $openid
	 * @param string $email
	 * @param string $label
	 * @param string|NULL $group
	 * @return boolean
	 */
	public function addOpenIdUser($openid, $email = '', $label = '', $group = '') {
		$acModel = $this->getAccessControlModel();
		$acModelUri = $acModel->getModelUri();
		$store = $acModel->getStore();
		$userUri = urldecode($openid);
		// uri rdf:type sioc:User
		$store->addStatement(
			$acModelUri,
			$userUri,
			EF_RDF_TYPE,
			array(
				 'value' => $this->configuration->ac->user->class,
				 'type' => 'uri'
			),
			false
		);
		if (!empty($email)) {
			// Check whether email already starts with mailto:
			if (substr($email, 0, 7) !== 'mailto:') {
				$email = 'mailto:' . $email;
			}
			// uri sioc:mailbox email
			$store->addStatement(
				$acModelUri,
				$userUri,
				$this->configuration->ac->user->mail,
				array(
					 'value' => $email,
					 'type' => 'uri'
				),
				false
			);
		}
		if (!empty($label)) {
			// uri rdfs:label $label
			$store->addStatement(
				$acModelUri,
				$userUri,
				EF_RDFS_LABEL,
				array(
					 'value' => $label,
					 'type' => 'literal'
				),
				false
			);
		}
		if (!empty($group)) {
			$store->addStatement(
				$acModelUri,
				$group,
				$this->configuration->ac->group->membership,
				array(
					 'value' => $userUri,
					 'type' => 'uri'
				),
				false
			);
		}
		return true;
	}

	/**
	 * Adds a new user to the store.
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $email
	 * @param string|NULL $userGroupUri
	 * @return boolean
	 */
	public function addUser($username, $password, $email, $userGroupUri = '') {
		$acModel = $this->getAccessControlModel();
		$acModelUri = $acModel->getModelUri();
		$store = $acModel->getStore();
		$userUri = $acModelUri . urlencode($username);
		$store->addStatement(
			$acModelUri,
			$userUri,
			EF_RDF_TYPE,
			array(
				 'value' => $this->configuration->ac->user->class,
				 'type' => 'uri'
			),
			false
		);
		$store->addStatement(
			$acModelUri,
			$userUri,
			$this->configuration->ac->user->name,
			array(
				 'value' => $username,
				 'type' => 'literal',
				 'datatype' => EF_XSD_NS . 'string'
			),
			false
		);
		// Check whether email already starts with mailto:
		if (substr($email, 0, 7) !== 'mailto:') {
			$email = 'mailto:' . $email;
		}
		$store->addStatement(
			$acModelUri,
			$userUri,
			$this->configuration->ac->user->mail,
			array(
				 'value' => $email,
				 'type' => 'uri'
			),
			false
		);
		$store->addStatement(
			$acModelUri,
			$userUri,
			$this->configuration->ac->user->pass,
			array(
				 'value' => sha1($password),
				 'type' => 'literal'
			),
			false
		);
		if (!empty($userGroupUri)) {
			$store->addStatement(
				$acModelUri,
				$userGroupUri,
				$this->configuration->ac->group->membership,
				array(
					 'value' => $userUri,
					 'type' => 'uri'
				),
				false
			);
		}
		return true;
	}

	/**
	 * Authenticates a user with a given username and password.
	 *
	 * @param string $username
	 * @param string $password
	 * @return Zendauthentication_Result
	 */
	public function authenticate($username = 'Anonymous', $password = '') {
		// Set up the authentication adapter.
		$adapter = $this->objectManager->create('T3\Semantic\Authentication\Adapter\Rdf', $username, $password);
		// Attempt authentication, saving the result.
		$result = $this->getAuthentication()->authenticate($adapter);
		// If the result is not valid, make sure the identity is cleared.
		if (!$result->isValid()) {
			$this->getAuthentication()->clearIdentity();
		}
		return $result;
	}

	/**
	 * @param string $get
	 * @param string $redirectUrl
	 * @return \Zend_Auth_Result
	 */
	public function authenticateWithFoafSsl($get = NULL, $redirectUrl = NULL) {
		// Set up the authentication adapter.
		$adapter = new \Erfurt_Auth_Adapter_FoafSsl($get, $redirectUrl);
		// Attempt authentication, saving the result.
		$result = $this->getAuthentication()->authenticate($adapter);
		// If the result is not valid, make sure the identity is cleared.
		if (!$result->isValid()) {
			$this->getAuthentication()->clearIdentity();
		}
		return $result;
	}

	/**
	 * The second step of the OpenID authentication process.
	 * Authenticates a user with a given OpenID. On success this
	 * method will not return but instead redirect the user to the
	 * specified URL.
	 *
	 * @param string $openId
	 * @param string $redirectUrl
	 * @return \Zend_Auth_Result
	 */
	public function authenticateWithOpenId($openId, $verifyUrl, $redirectUrl) {
		$adapter = new Erfurtauthentication_Adapter_OpenId($openId, $verifyUrl, $redirectUrl);
		$result = $this->getAuthentication()->authenticate($adapter);
		// If we reach this point, something went wrong with the authentication process...
		// So we always clear the identity.
		$this->getAuthentication()->clearIdentity();
		return $result;
	}

	/**
	 * Returns an instance of the access control class.
	 *
	 * @return \Erfurt_Ac_Default
	 */
	public function getAccessControl() {
		if (NULL === $this->accessControl) {
			$this->accessControl = new \Erfurt_Ac_Default();
		}
		return $this->accessControl;
	}

	public function setAccessControl($accessControl) {
		$this->accessControl = $accessControl;
	}

	/**
	 * Returns an instance of the access control model.
	 *
	 * @return \Erfurt_Rdf_Model
	 */
	public function getAccessControlModel() {
		if (NULL === $this->accessControlModel) {
			$this->accessControlModel = $this->getStore()
					->getModel($this->getAccessControlConfiguration()->modelUri, false);
		}

		return $this->accessControlModel;
	}

	/**
	 * Convenience shortcut for Ac_Default::getActionConfig().
	 *
	 * @param string $actionSpec The action to get the configuration for.
	 * @return array Returns the configuration for the given action.
	 */
	public function getActionConfig($actionSpec) {
		return $this->getAccessControl()->getActionConfig($actionSpec);
	}

	/**
	 * Returns the auth instance.
	 *
	 * @return \Zend_Auth
	 */
	public function getAuthentication() {
		if (NULL === $this->authentication) {
			$auth = $this->objectManager->get('\T3\Semantic\Authentication\Authentication');
			if (isset($this->getSessionConfiguration()->identifier)) {
				$sessionNamespace = 'Erfurt_Auth' . $this->getSessionConfiguration()->identifier;
				$auth->setStorage(new \Zend_Auth_Storage_Session($sessionNamespace));
			}
			$this->authentication = $auth;
		}
		return $this->authentication;
	}

	/**
	 * Returns a caching instance.
	 *
	 * @return \Zend_Cache_Core
	 */
	public function getCache() {
		if (NULL === $this->cache) {
			if (!isset($this->getCacheConfiguration()->lifetime) || ($this->getCacheConfiguration()->lifetime == -1)) {
				$lifetime = NULL;
			} else {
				$lifetime = $this->getCacheConfiguration()->lifetime;
			}
			$frontendOptions = array(
				'lifetime' => $lifetime,
				'automatic_serialization' => true
			);
			$this->cache = new \Erfurt_Cache_Frontend_ObjectCache($frontendOptions);
			$backend = $this->getCacheBackend();
			$this->cache->setBackend($backend);
		}
		return $this->cache;
	}

	/**
	 * Returns a directory, which can be used for file-based caching.
	 * If no such (writable) directory is found, false is returned.
	 *
	 * @return string|false
	 */
	public function getCacheDir() {
		if (isset($this->getCacheConfiguration()->path)) {
			$matches = array();
			if (!(preg_match('/^(\w:[\/|\\\\]|\/)/', $this->getCacheConfiguration()->path, $matches) === 1)) {
				$this->getCacheConfiguration()->path = EF_BASE . $this->getCacheConfiguration()->path;
			}
			if (is_writable($this->getCacheConfiguration()->path)) {
				return $this->getCacheConfiguration()->path;
			} else {
				// Should throw an exception.
				return false;
				//return $this->getTmpDir();
			}
		} else {
			return false;
			//return $this->getTmpDir();
		}
	}

	/**
	 * Returns the configuration object.
	 *
	 * @return \Zend_Config
	 * @throws \Erfurt_Exception Throws an exception if no config is loaded.
	 */
	public function getConfiguration() {
		if (NULL === $this->configuration) {
			throw new Exception\ConfigurationNotLoadedException('Configuration was not loaded.', 1302769700);
		} else {
			return $this->configuration;
		}
	}

	/**
	 * Returns the configuration object.
	 *
	 * @return \T3\Semantic\Configuration\AccessControlConfiguration
	 * @throws \T3\Semantic\Exception\ConfigurationNotLoadedException Throws an exception if no config is loaded.
	 */
	public function getAccessControlConfiguration() {
		if (NULL === $this->accessControlConfiguration) {
			throw new Exception\ConfigurationNotLoadedException('Access Control Configuration was not loaded.', 1303200116);
		} else {
			return $this->accessControlConfiguration;
		}
	}

	/**
	 * Returns the configuration object.
	 *
	 * @return \T3\Semantic\Configuration\AuthenticationConfiguration
	 * @throws \T3\Semantic\Exception\ConfigurationNotLoadedException Throws an exception if no config is loaded.
	 */
	public function getAuthenticationConfiguration() {
		if (NULL === $this->authenticationConfiguration) {
			throw new Exception\ConfigurationNotLoadedException('Authentication Configuration was not loaded.', 1303200166);
		} else {
			return $this->authenticationConfiguration;
		}
	}

	/**
	 * Returns the configuration object.
	 *
	 * @return \T3\Semantic\Configuration\CacheConfiguration
	 * @throws \T3\Semantic\Exception\ConfigurationNotLoadedException Throws an exception if no config is loaded.
	 */
	public function getCacheConfiguration() {
		if (NULL === $this->cacheConfiguration) {
			throw new Exception\ConfigurationNotLoadedException('Cache Configuration was not loaded.', 1303200192);
		} else {
			return $this->cacheConfiguration;
		}
	}

	/**
	 * Returns the configuration object.
	 *
	 * @return \T3\Semantic\Configuration\NamespacesConfguration
	 * @throws \T3\Semantic\Exception\ConfigurationNotLoadedException Throws an exception if no config is loaded.
	 */
	public function getNamespacesConfiguration() {
		if (NULL === $this->namespacesConfiguration) {
			throw new Exception\ConfigurationNotLoadedException('Namespaces Configuration was not loaded.', 1302772392);
		} else {
			return $this->namespacesConfiguration;
		}
	}

	/**
	 * Returns the configuration object.
	 *
	 * @return \T3\Semantic\Configuration\SessionConfiguration
	 * @throws \T3\Semantic\Exception\ConfigurationNotLoadedException Throws an exception if no config is loaded.
	 */
	public function getSessionConfiguration() {
		if (NULL === $this->sessionConfiguration) {
			throw new Exception\ConfigurationNotLoadedException('Session Configuration was not loaded.', 1303200235);
		} else {
			return $this->sessionConfiguration;
		}
	}

	/**
	 * Returns the configuration object.
	 *
	 * @return \T3\Semantic\Configuration\StoreConfguration
	 * @throws \T3\Semantic\Exception\ConfigurationNotLoadedException Throws an exception if no config is loaded.
	 */
	public function getStoreConfiguration() {
		if (NULL === $this->storeConfiguration) {
			throw new Exception\ConfigurationNotLoadedException('Store Configuration was not loaded.', 1302772396);
		} else {
			return $this->storeConfiguration;
		}
	}

	/**
	 * Returns the configuration object.
	 *
	 * @return \T3\Semantic\Configuration\SystemOntologyConfiguration
	 * @throws \T3\Semantic\Exception\ConfigurationNotLoadedException Throws an exception if no config is loaded.
	 */
	public function getSystemOntologyConfiguration() {
		if (NULL === $this->systemOntologyConfiguration) {
			throw new Exception\ConfigurationNotLoadedException('System Ontology Configuration was not loaded.', 1303200655);
		} else {
			return $this->systemOntologyConfiguration;
		}
	}

	/**
	 * Returns the configuration object.
	 *
	 * @return \T3\Semantic\Configuration\UriConfiguration
	 * @throws \T3\Semantic\Exception\ConfigurationNotLoadedException Throws an exception if no config is loaded.
	 */
	public function getUriConfiguration() {
		if (NULL === $this->uriConfiguration) {
			throw new Exception\ConfigurationNotLoadedException('Uri Configuration was not loaded.', 1303203612);
		} else {
			return $this->uriConfiguration;
		}
	}

	/**
	 * Returns the event dispatcher instance.
	 *
	 * @return \Erfurt_Event_Dispatcher
	 */
	public function getEventDispatcher() {
		$eventDispatcher = \Erfurt_Event_Dispatcher::getInstance();
		return $eventDispatcher;
	}

	/**
	 * Returns a preconfigured Http_Client
	 *
	 * @param string $uri
	 * @param array $options
	 * @return \Zend_Http_Client
	 */
	public function getHttpClient($uri, $options = array()) {
		$config = $this->getConfig();
		$defaultOptions = array();
		if (isset($config->proxy)) {
			$proxy = $config->proxy;
			if (isset($proxy->host)) {
				$defaultOptions['proxy_host'] = $proxy->host;
				$defaultOptions['adapter'] = '\Zend_Http_Client_Adapter_Proxy';
				if (isset($proxy->port)) {
					$defaultOptions['proxy_port'] = (int)$proxy->port;
				}
				if (isset($proxy->username)) {
					$defaultOptions['proxy_user'] = $proxy->username;
				}
				if (isset($proxy->password)) {
					$defaultOptions['proxy_pass'] = $proxy->password;
				}
			}
		}
		$finalOptions = array_merge($defaultOptions, $options);
		$client = new \Zend_Http_Client($uri, $finalOptions);
		return $client;
	}

	/**
	 * Returns the namespace management module.
	 *
	 * @return \Erfurt_Namespaces
	 */
	public function getNamespaces() {
		if (NULL === $this->namespaces) {
			// options
			$namespacesOptions = array(
				'standard_prefixes' => ($this->getNamespacesConfiguration() !== NULL) ? $this
						->getNamespacesConfiguration()->toArray() : array(),
				'reserved_names' => isset($this->getUriConfiguration()->schemata) ? $this->getUriConfiguration()->schemata->toArray() : array()
			);
			$this->namespaces = new \Erfurt_Namespaces($namespacesOptions);
		}
		return $this->namespaces;
	}

	/**
	 * Returns a query cache instance.
	 *
	 * @return Erfurt_Cache_Frontend_QueryCache
	 */
	public function getQueryCache() {
		if (NULL === $this->queryCache) {
			$this->queryCache = new \Erfurt_Cache_Frontend_QueryCache();
			$backend = $this->getQueryCacheBackend();
			$this->queryCache->setBackend($backend);
		}
		return $this->queryCache;
	}

	/**
	 * Returns a instance of the store.
	 *
	 * @return \T3\Semantic\Store\Store
	 */
	public function getStore() {
		return $this->store;
	}

	/**
	 * @var \T3\Semantic\Store\Store $store
	 */
	public function setStore(\T3\Semantic\Store\Store $store) {
		$this->store = $store;
	}

	/**
	 * Returns an instance of the system ontology model.
	 *
	 * @return \Erfurt_Rdf_Model
	 */
	public function getSysOntModel() {
		if (NULL === $this->systemOntologyModel) {
			$this->systemOntologyModel = $this
					->getStore()
					->getModel($this->getSystemOntologyConfiguration()->modelUri, false);
		}
		return $this->systemOntologyModel;
	}

	/**
	 * Returns a valid tmp folder depending on the OS used.
	 *
	 * @return string
	 */
	public function getTemporaryDirectory() {
		// We use a Zend method here, for it already checks the OS.
		$temp = new \Zend_Cache_Backend();
		return $temp->getTmpDir();
	}

	/**
	 * Convenience shortcut for Auth_Adapter_Rdf::getUsers().
	 *
	 * @return array Returns a list of users.
	 */
	public function getUsers() {
		$tempAdapter = new \Erfurt_Auth_Adapter_Rdf();
		return $tempAdapter->getUsers();
	}

	/**
	 * Returns a versioning instance.
	 *
	 * @return \Erfurt_Versioning
	 */
	public function getVersioning() {
		if (NULL === $this->versioning) {
			$this->versioning = new \Erfurt_Versioning();
		}
		return $this->versioning;
	}

	/**
	 * Convenience shortcut for Ac_Default::isActionAllowed().
	 *
	 * @param string $actionSpec The action to check.
	 * @return boolean Returns whether the given action is allowed for the current user.
	 */
	public function isActionAllowed($actionSpec) {
		return $this->getAccessControl()->isActionAllowed($actionSpec);
	}

	/**
	 * The third and last step of the OpenID authentication process.
	 * Checks whether the response is a valid OpenID result and
	 * returns the appropriate auth result.
	 *
	 * @param array $get The query part of the authentication request.
	 * @return \Zend_Auth_Result
	 */
	public function verifyOpenIdResult($get) {
		$adapter = new \Erfurt_Auth_Adapter_OpenId(NULL, NULL, NULL, $get);
		$result = $this->getAuthentication()->authenticate($adapter);
		if (!$result->isValid()) {
			$this->getAuthentication()->clearIdentity();
		}
		return $result;
	}

	/**
	 * Returns a cache backend as configured.
	 *
	 * @return \Zend_Cache_Backend
	 * @throws \Erfurt_Exception
	 */
	protected function getCacheBackend() {
		if (NULL === $this->cacheBackend) {
			// TODO: fix cache, temporarily disabled
			if (!isset($this->getCacheConfiguration()->enable) || !(boolean)$this->getCacheConfiguration()->enable) {
				$this->cacheBackend = new \Erfurt_Cache_Backend_Null();
			}
				// cache is enabled
			else {
				// check for the cache type and throw an exception if cache type is not set
				if (!isset($this->getCacheConfiguration()->type)) {
					throw new \Erfurt_Exception('Cache type is not set in config.');
				} else {
					// check the type an whether type is supported
					switch (strtolower($this->getCacheConfiguration()->type)) {
						case 'database':
							$this->cacheBackend = new \Erfurt_Cache_Backend_Database();
							break;
						case 'sqlite':
							if (isset($this->getCacheConfiguration()->sqlite->dbname)) {
								$backendOptions = array(
									'cache_db_complete_path' => $this->getCacheDir() . $this->getCacheConfiguration()->sqlite->dbname
								);
							} else {
								throw new \Erfurt_Exception(
									'Cache database filename must be set for sqlite cache backend'
								);
							}
							$this->cacheBackend = new \Zend_Cache_Backend_Sqlite($backendOptions);
							break;
						default:
							throw new \Erfurt_Exception('Cache type is not supported.');
					}
				}
			}
		}
		return $this->cacheBackend;
	}

	/**
	 * Returns a query cache backend as configured.
	 *
	 * @return \Erfurt_Cache_Backend_QueryCache_Backend
	 * @throws \Erfurt_Exception
	 */
	protected function getQueryCacheBackend() {
		if (NULL === $this->queryCacheBackend) {
			$backendOptions = array();
			if (!isset($this->getCacheConfiguration()->query->enable) || ((boolean)$this->getCacheConfiguration()->query->enable === false)) {
				$this->queryCacheBackend = new \Erfurt_Cache_Backend_QueryCache_Null();
			} else {
				// cache is enabled
				// check for the cache type and throw an exception if cache type is not set
				if (!isset($this->getCacheConfiguration()->query->type)) {
					throw new \Erfurt_Exception('Cache type is not set in config.');
				} else {
					// check the type an whether type is supported
					switch (strtolower($this->getCacheConfiguration()->query->type)) {
						case 'database':
							$this->queryCacheBackend = new \Erfurt_Cache_Backend_QueryCache_Database();
							break;
						#                       case 'file':
						#                            $this->queryCacheBackend = new Erfurtcache_Backend_QueryCache_File();
						#                            break;
						#
						#                       case 'memory':
						#                            $this->queryCacheBackend = new Erfurtcache_Backend_QueryCache_Memory();
						#                            break;
						default:
							throw new \Erfurt_Exception('Cache type is not supported.');
					}
				}
			}
		}
		return $this->queryCacheBackend;
	}

}

?>