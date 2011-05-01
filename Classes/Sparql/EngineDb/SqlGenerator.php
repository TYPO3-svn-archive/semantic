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
class SqlGenerator {

	/**
	 *   Column names for subjects, predicates and
	 *   objects for easy access via their character
	 *   names (spo).
	 *
	 * @var array
	 */
	public $arTableColumnNames = array(
		's' => array(
			'value' => 'subject',
			'is' => 'subject_is'
		),
		'p' => array(
			'value' => 'predicate'
		),
		'o' => array(
			'value' => 'object',
			'is' => 'object_is'
		),
		'datatype' => array(
			'value' => 'l_datatype',
			'empty' => "=''",
			'not_empty' => "!=''"
		),
		'language' => array(
			'value' => 'l_language',
			'empty' => "=''",
			'not_empty' => "!=''"
		)
	);

	public $arTypeValues = array(
		'r' => '"r"',
		'b' => '"b"',
		'l' => '"l"'
	);

	public $strColEmpty = '= ""';
	public $strColNotEmpty = '!= ""';

}

?>