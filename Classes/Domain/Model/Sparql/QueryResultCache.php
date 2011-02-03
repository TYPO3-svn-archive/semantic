<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Jochen Rau <jochen.rau@typoplanet.de>, typoplanet
 *
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
 * Sparql_QueryResult
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Semantic_Domain_Model_Sparql_QueryResultCache implements Tx_Semantic_Domain_Model_Sparql_QueryResultCacheInterface {

	/**
	 * @var t3lib_cache_frontend_VariableFrontend
	 */
	protected $cache;

	/**
	 * Initialize cache instance to be ready to use
	 *
	 * @return void
	 */
	public function initializeObject() {
		t3lib_cache::initializeCachingFramework();
		try {
			$this->cache = $GLOBALS['typo3CacheManager']->getCache('cache_semantic_sparql_queryresult');
		} catch (t3lib_cache_exception_NoSuchCache $exception) {
			$this->cache = $GLOBALS['typo3CacheFactory']->create(
				'cache_semantic_sparql_queryresult',
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_semantic_sparql_queryresult']['frontend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_semantic_sparql_queryresult']['backend'],
				$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['cache_semantic_sparql_queryresult']['options']
			);
		}
	}

	/**
	 * Adds a raw query result of the given query to the cache.
	 *
	 * @param	Tx_Semantic_Domain_Model_Sparql_QueryInterface The query which identifies the cached raw query result
	 * @param	array The raw query result array
	 * @return	void
	 */
	public function setFor(Tx_Semantic_Domain_Model_Sparql_QueryInterface $query, array $data) {
		$this->cache->set($query->getHash(), json_encode($data), array(), 0);
	}

	/**
	 * Returns the cached query result of the given query.
	 *
	 * @param	Tx_Semantic_Domain_Model_Sparql_QueryInterface The query which identifies the cached raw query result
	 * @return	array The cached query result
	 */
	public function getResultFor(Tx_Semantic_Domain_Model_Sparql_QueryInterface $query) {
		return json_decode($this->cache->get($query->getHash()), TRUE);
	}

	/**
	 * Checks if a query result for the specified query exists.
	 *
	 * @param	Tx_Semantic_Domain_Model_Sparql_QueryInterface The query which identifies the cached raw query result
	 * @return	boolean	TRUE if such an entry exists, FALSE if not
	 */
	public function hasResultFor(Tx_Semantic_Domain_Model_Sparql_QueryInterface $query) {
		return $this->cache->has($query->getHash());
	}

}
?>