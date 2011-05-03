<?php
declare(ENCODING = 'utf-8');
namespace T3\Semantic\Uri;
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
 * Simple static class for performing regular expression-based URI checking and normalizing.
 *
 * @category Erfurt
 * @package Uri
 * @copyright Copyright (c) 2009 {@link http://aksw.org AKSW}
 * @license http://opensource.org/licenses/gpl-license.php GNU General Public License (GPL)
 * @author Norman Heino <norman.heino@gmail.com>
 */
class Uri {

	/**
	 * Regular expression to split the schema-specific part of HTTP URIs
	 * @var string
	 */
	protected static $httpSplit = '/^\/\/(.+@)?(.+?)(\/.*)?$/';

	/**
	 * Regular expression to match the whole URI
	 * @var string
	 */
	protected static $regExp = '/^([a-zA-Z][a-zA-Z0-9+.-]+):([^\x00-\x0f\x20\x7f<>{}|\[\]`"^\\\\])+$/';

	/**
	 * Checks the general syntax of a given URI. Protocol-specific syntaxes are not checked.
	 * Instead, only characters disallowed an all URIs lead to a rejection of the check.
	 *
	 * @param string $uri
	 * @return string
	 */
	public static function check($uri) {
		return (preg_match(self::$regExp, (string)$uri) === 1);
	}

	/**
	 * Normalizes the given URI according to {@link http://www.ietf.org/rfc/rfc2396.txt}.
	 * In particular, protocol and -- for HTTP URIs -- the server part are
	 * normalized to lower case.
	 *
	 * @param string $uri The URI to be normalized
	 * @return string
	 */
	public static function normalize($uri) {
		if (!self::check($uri)) {
			throw new Exception('The supplied string is not a valid URI. ');
		}

		// split into schema and schema-specific part
		$parts = explode(':', $uri, 2);
		$schema = strtolower($parts[0]);
		$schemaSpecific = isset($parts[1]) === true ? $parts[1] : '';

		// schema-only normalization
		$normalized = $schema
					  . ':'
					  . $schemaSpecific;

		// check for HTTP(S) URIs
		if (strpos('http', $schema) !== false) {
			// here we can do more ...
			$matches = array();
			preg_match(self::$httpSplit, $schemaSpecific, $matches);

			$authority = $matches[1];
			$server = strtolower($matches[2]);
			$path = isset($matches[3]) ? $matches[3] : '';

			// server-part normalization
			$normalized = $schema
						  . '://'
						  . $authority
						  . $server
						  . $path;
		}

		return $normalized;
	}

}

?>