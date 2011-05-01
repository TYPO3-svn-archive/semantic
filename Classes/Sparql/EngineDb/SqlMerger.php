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
*   Creates an sql string from an sql array
*
*   @author Christian Weiske <cweiske@cweiske.de>
*   @license http://www.gnu.org/licenses/lgpl.html LGPL
*
*   @subpackage sparql
*/
use \T3\Semantic\Sparql;
class SqlMerger {

	public static function getSelect(Sparql\Query $query, $arSqls, $strAdditional = '') {
		if (count($arSqls) == 1) {
			return implode('', $arSqls[0]) . $strAdditional;
		}
		//union
		$strUnion = 'UNION' .
					($query->getResultForm() == 'select distinct' ? '' : ' ALL');
		$ar = array();
		foreach ($arSqls as $arSql) {
			$ar[] = implode('', $arSql) . $strAdditional;
		}
		return '(' . implode(') ' . $strUnion . ' (', $ar) . ')';
	}

	//public static function getSelect(Query $query, $arSqls, $strAdditional = '')

	public static function getCount(Sparql\Query $query, $arSqls, $strAdditional = '') {
		if (count($arSqls) == 1) {
			return 'SELECT COUNT(*) as count ' . $arSqls[0]['from'] . $arSqls[0]['where'] . $strAdditional;
		}
		$ar = array();
		foreach ($arSqls as $arSql) {
			$ar[] = implode('', $arSql) . $strAdditional;
		}
		return 'SELECT (' . implode(') + (', $ar) . ') as count';
	}
	//public static function getCount(Query $query, $arSqls, $strAdditional = '')

}

?>