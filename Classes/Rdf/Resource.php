<?php
declare(ENCODING = 'utf-8') ;
namespace T3\Semantic\Rdf;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Thomas Maroschik <tmaroschik@dfau.de>
 *  All rights reserved
 *
 *  This class is a port of the corresponding class of the
 * {@link http://aksw.org/Projects/Erfurt Erfurt} project.
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
 * Represents a basic RDF resource.
 *
 * @package $PACKAGE$
 * @subpackage $SUBPACKAGE$
 * @scope prototype
 */
class Resource extends Node {
	/**
	 * Maximum path length for the CBD.
	 * @var int
	 */
	const DESCRIPTION_MAX_DEPTH = 3;

	/**
	 * The model to which this resource belongs.
	 * @var Erfurt_Rdf_Model
	 */
	protected $model = null;

	/**
	 * The name of the resource (either a IRI or a local name)
	 * @var string
	 */
	protected $name = null;

	/**
	 * Holds the CBD or null if no property has been queried.
	 * @var array
	 */
	protected $description = null;

	/**
	 * The namespace this resource's IRI is contained in.
	 * @var string
	 */
	protected $namespace = null;

	/**
	 * A namespace prefix.
	 * @var string
	 */
	protected $prefix = null;

	/**
	 * Delimiter between namespace prefix and local name.
	 * @var string
	 */
	protected $qualifiedNameDelimiter = ':';

	/**
	 * Whether this resource identifies a blank node
	 * @var boolean
	 */
	protected $isBlankNode = false;

	/**
	 * An optional locator for the resource.
	 *
	 * If this property is set, the value of it (a URL) is used, when data
	 * for this resource should be fetched.
	 *
	 * @var string
	 */
	protected $locator = null;

	/**
	 * Constructor
	 *
	 * @param string $iri
	 * @param Erfurt_Rdf_Model $model
	 */
	public function __construct($iri, Erfurt_Rdf_Model $model = null) {
		$this->model = $model;
		$namespaces = $this->model ? $this->model->getNamespaces() : array();
		$matches = array();

		// parse namespace/local part
		preg_match('/^(.+[#\/])(.*[^#\/])$/', $iri, $matches);

		$flag = false;
		if (count($matches) >= 3) {
			// match namespace
			if (array_key_exists($matches[1], $namespaces)) {
				$flag = true;
				$this->namespace = $matches[1];
				$this->name = $matches[2];
				$this->prefix = $namespaces[$this->namespace];
			} else {
				$flag = true;
				$this->namespace = $matches[1];
				$this->name = $matches[2];
			}
		}

		// no namespace found/matched
		if (!$flag) {
			$this->name = $iri;
		}
	}

	/**
	 * Returns a string representation of this resource.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this->getIri();
	}

	/**
	 * returns the serialized representation (string) of this resource according
	 * to the notation parameter. It always uses the pretty format option
	 * and the access control.
	 *
	 * @param string $notation the specified notation (see Erfurt_Syntax_RdfSerializer
	 *  for possible arguments)
	 *
	 * @return string the representation of this resource in a specified notation
	 */
	public function serialize($notation = 'xml') {

		require_once('Erfurt/Syntax/RdfSerializer.php');
		$serializer = Erfurt_Syntax_RdfSerializer::rdfSerializerWithFormat($notation);
		return $serializer->serializeResourceToString($this->getIri(), $this->model->getModelIri(), true);
	}

	public function getDescription($maxDepth = self::DESCRIPTION_MAX_DEPTH) {
		if (null === $this->description) {
			$this->description = $this->_fetchDescription($maxDepth);
		}

		return $this->description;
	}


	/**
	 * Returns the resource's IRI
	 *
	 * @return string
	 */
	public function getIri() {
		return $this->namespace . $this->name;
	}

	/**
	 * Returns an optional locator for the resource, or the IRI of it, if no
	 * locator value was set.
	 *
	 * @return string
	 */
	public function getLocator() {
		// If no locator was explicitly set, we return the IRIof the resource.
		if (null === $this->locator) {
			return $this->getIri();
		}
		return $this->locator;
	}

	/**
	 * Set a locator URL for this resource.
	 *
	 * @param string $locator
	 */
	public function setLocator($locator) {
		$this->locator = $locator;
	}

	/**
	 * Returns a qualified name for the resource or null.
	 *
	 * @return string|null
	 */
	public function getQualifiedName() {
		if ($this->prefix) {
			$qName = $this->prefix
					 . $this->qualifiedNameDelimiter
					 . $this->name;

			return $qName;
		}
	}

	public function getNamespace() {
		return $this->namespace;
	}

	public function getLocalName() {
		return $this->name;
	}

	protected function _fetchDescription($maxDepth) {
		$query = new Erfurt_Sparql_SimpleQuery();
		$query->setProloguePart('SELECT ?p ?o')
				->setWherePart(sprintf('{<%s> ?p ?o . }', $this->getIri()));
		$description = array();

		if (($maxDepth > 0) && $result = $this->model->sparqlQuery($query, array('result_format' => 'extended'))) {
			foreach ($result['results']['bindings'] as $row) {
				$property = $row['p']['value'];
				$this->_descriptionResource($property);

				$currentValue = array(
					// typed-literal --> literal
					// 'type' => str_replace('typed-', '', $row['o']['type']),
					'type' => $row['o']['type'],
					'value' => $row['o']['value']
				);

				if ($row['o']['type'] == 'uri') {
					$this->_descriptionResource($row['o']['value']);
				} else {
					if ($row['o']['type'] == 'typed-literal') {
						$currentValue['type'] = 'literal';
						$currentValue['datatype'] = $row['o']['datatype'];
					} else {
						if (isset($row['o']['xml:lang'])) {
							$currentValue['lang'] = $row['o']['xml:lang'];
						}
					}
				}

				if (!array_key_exists($property, $description)) {
					$description[$property] = array();
				}

				array_push($description[$property], $currentValue);

				if ($row['o']['type'] === 'bnode') {
					$nodeId = $row['o']['value'];
					$bNode = self::initWithBlankNode($nodeId);
					$nodeKey = sprintf('_:%s', $nodeId);

					$description[$nodeKey] = $bNode->getDescription($maxDepth - 1);
				}
			}
		}

		return array(
			$this->getIri() => $description
		);
	}

	protected function _descriptionResource($uri) {
	}

	// ------------------------------------------------------------------------

	public static function initWithIri($iri) {
		$resource = new self($iri);
		return $resource;
	}

	public static function initWithUri($uri) {
		$resource = new self($uri);
		return $resource;
	}

	public static function initWithNamespaceAndLocalName($namespace, $local) {
		$resource = new self($namespace . $local);
		return $resource;
	}

	public static function initWithBlankNode($id) {
		$resource = new self($id);
		$resource->isBlankNode = true;
		return $resource;
	}

	public function isBlankNode() {
		return $this->isBlankNode;
	}

	public function getId() {
		// Alias for BlankNodes
		return $this->getIri();
	}

	public function getUri() {
		return $this->getIri();
	}
}

?>