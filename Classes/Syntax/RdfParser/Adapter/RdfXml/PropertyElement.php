<?php
declare(ENCODING = 'utf-8');
namespace T3\Semantic\Syntax\RdfParser\Adapter\RdfXml;
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
class PropertyElement {

	protected $uri = null;
	protected $reificationUri = null;
	protected $datatype = null;
	protected $parseAsCollection = false;
	protected $lastListResource = null;

	public function __construct($uri) {
		$this->uri = $uri;
	}

	public function getUri() {
		return $this->uri;
	}

	public function isReified() {
		if (null !== $this->reificationUri) {
			return true;
		} else {
			return false;
		}
	}

	public function setReificationUri($reifUri) {
		$this->reificationUri = $reifUri;
	}

	public function getReificationUri() {
		return $this->reificationUri;
	}

	public function setDatatype($datatype) {
		$this->datatype = $datatype;
	}

	public function getDatatype() {
		return $this->datatype;
	}

	public function parseAsCollection() {
		return $this->parseAsCollection;
	}

	public function setParseAsCollection($parseAsCollection) {
		$this->parseAsCollection = $parseAsCollection;
	}

	public function getLastListResource() {
		return $this->lastListResource;
	}

	public function setLastListResource($lastListResource) {
		$this->lastListResource = $lastListResource;
	}
}

?>