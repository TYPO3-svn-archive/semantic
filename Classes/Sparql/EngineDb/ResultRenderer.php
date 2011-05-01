<?php
declare(ENCODING = 'utf-8') ;
namespace T3\Semantic\Sparql\EngineDb;
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
 *   Result renderer interface that any result renderer needs to implement.
 *   A result renderer converts the raw database results into a
 *   - for the user - usable result format, e.g. php arrays, xml, json and
 *   so on.
 *
 *   @author Christian Weiske <cweiske@cweiske.de>
 *   @license http://www.gnu.org/licenses/lgpl.html LGPL
 *
 *   @subpackage sparql
 */
use \T3\Semantic\Sparql;
interface ResultRenderer {

	/**
	 *   Converts the database results into the desired output format
	 *   and returns the result.
	 *
	 * @param array $arRecordSets  Array of (possibly several) SQL query results.
	 * @param Query $query	 SPARQL query object
	 * @param SparqlEngineDb $engine   Sparql Engine to query the database
	 * @return mixed   The result as rendered by the result renderers.
	 */
	public function convertFromDbResults($arRecordSets, Sparql\Query $query, $engine, $vars);
}
?>