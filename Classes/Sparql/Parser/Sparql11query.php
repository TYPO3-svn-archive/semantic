<?php
declare(ENCODING = 'utf-8') ;
namespace T3\Semantic\Sparql\Parser;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Maroschik <tmaroschik@dfau.de>
 *  All rights reserved
 *
 *  This class is a port of the corresponding class of the
 *  {@link http://aksw.org/Projects/Erfurt Erfurt} project.
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
 * @category Erfurt
 * @package Sparql_Parser_Sparql
 * @author Rolland Brunec <rollxx@gmail.com>
 * @copyright Copyright (c) 2010 {@link http://aksw.org aksw}
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License (GPL)
 */
class Sparql11query implements SparqlInterface {

	function __construct($parserOptions = array()) {
	}

	public static function initFromString($queryString, $parserOptions = array()) {
		$input = new Util\CaseInsensitiveStream($queryString);
		$lexer = new Sparql11\QueryLexer($input);
		$tokens = new \CommonTokenStream($lexer);
		$parser = new Sparql11\QueryParser($tokens);
		$retval = $parser->parse();
		return array('retval' => $retval, 'errors' => array_merge($lexer->getErrors(), $parser->getErrors()));
	}

}

?>