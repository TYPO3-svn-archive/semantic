<?php
declare(ENCODING = 'utf-8') ;
namespace T3\Semantic\Sparql\Query2;
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
 * OntoWiki Sparql Query - BooleanLiteral
 *
 * represent "true" and "false"
 *
 * @package Semantic
 * @scope prototype
 */
class BooleanLiteral extends ElementHelper implements Interfaces\GraphTerm, Interfaces\PrimaryExpression {

	protected $value;

	/**
	 * @param bool $bool
	 */
	public function __construct($bool) {
		if (is_bool($bool)) {
			$this->value = $bool;
		} else {
			throw new \RuntimeException("Argument 1 passed to Erfurt_Sparql_Query2_BooleanLiteral::__construct must be boolean, instance of '.typeHelper($bool).' given");
		}
	}

	/**
	 * getSparql
	 * build a valid sparql representation of this obj - should be 'true' or 'false'
	 * @return string
	 */
	public function getSparql() {
		return $this->value ? 'true' : 'false';
	}

	public function __toString() {
		return $this->getSparql();
	}
}
?>
