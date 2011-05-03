<?php
declare(ENCODING = 'utf-8') ;
namespace T3\Semantic\Owl;
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
 * Owl Model class
 *
 * @package $PACKAGE$
 * @subpackage $SUBPACKAGE$
 * @scope prototype
 */
class Model extends \T3\Semantic\Rdf\Model {
	/**
	 * Imported graph IRIs
	 * @var array
	 */
	protected $imports = null;

	/**
	 * Constructor
	 *
	 * @param string $modelIri
	 * @param string $baseIri
	 * @param array $imports
	 */
	public function __construct($modelIri, $baseIri = null, array $imports = array()) {
		parent::__construct($modelIri, $baseIri);

		$this->imports = $imports;
	}

	/**
	 * Returns an array of graph IRIs this model owl:imports.
	 *
	 * @return array
	 */
	public function getImports() {
		if (!$this->imports) {
			$store = $this->getStore();
			$this->imports = array_values($store->getImportsClosure($this->getModelUri()));
		}
		return $this->imports;
	}

	/**
	 * Resource factory method
	 *
	 * @return \T3\Semantic\Owl\Resource
	 */
	public function getResource($resourceIri) {
		return parent::getResource($resourceIri);
	}

}

?>