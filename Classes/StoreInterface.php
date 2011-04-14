 <?php
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
 * Enter descriptions here
 *
 * @package $PACKAGE$
 * @subpackage $SUBPACKAGE$
 * @scope prototype
 * @entity
 * @api
 */
interface Tx_Semantic_StoreInterface {

	/**
	 * Adds statements in an array to the graph specified by $graphIri.
	 *
	 * @param string $graphIri
	 * @param array  $statementsArray
	 *
	 * @throws Erfurt_Exception
	 */
	public function addMultipleStatements($graphUri, array $statementsArray, $useAc = true);

	/**
	 * Adds a statement to the graph specified by $modelIri.
	 * @param string $graphUri
	 * @param string $subject (IRI or blank node)
	 * @param string $predicate (IRI, no blank node!)
	 * @param string $object (IRI, blank node or literal)
	 * @param array $options An array containing two keys 'subject_type' and 'object_type'. The value of each is
	 * one of the defined constants of Erfurt_Store: TYPE_IRI, TYPE_BLANKNODE and TYPE_LITERAL. In addtion to this
	 * two keys the options array can contain two keys 'literal_language' and 'literal_datatype', but only in case
	 * the object of the statement is a literal.
	 *
	 * @throws Erfurt_Exception Throws an exception if adding of statements fails.
	 */
	public function addStatement($graphUri, $subject, $predicate, $object, $useAcl = true);

	/**
	 * Checks whether the store has been set up yet and imports system
	 * ontologies if necessary.
	 */
	public function checkSetup();

	/**
	 * Creates the table specified by $tableSpec according to backend-specific
	 * create table statement.
	 *
	 * @param array $tableSpec An associative array of SQL column names and columnd specs.
	 */
	public function createTable($tableName, array $columns);

	/**
	 * Deletes all statements that match the triple pattern specified.
	 *
	 * @param string $modelIri
	 * @param mixed triple pattern $subject (string or null)
	 * @param mixed triple pattern $predicate (string or null)
	 * @param mixed triple pattern $object (string or null)
	 * @param array $options An array containing two keys 'subject_type' and 'object_type'. The value of each is
	 * one of the defined constants of Erfurt_Store: TYPE_IRI, TYPE_BLANKNODE and TYPE_LITERAL. In addtion to this
	 * two keys the options array can contain two keys 'literal_language' and 'literal_datatype'.
	 *
	 * @throws Erfurt_Exception
	 */
	public function deleteMatchingStatements($graphUri, $subject, $predicate, $object, $options = array());

	/**
	 * Deletes statements in an array from the graph specified by $graphIri.
	 *
	 * @param string $graphIri
	 * @param array  $statementsArray
	 *
	 * @throws Erfurt_Exception
	 */
	public function deleteMultipleStatements($graphUri, array $statementsArray);

	/**
	 * @param string $modelIri The Iri, which identifies the model.
	 * @param boolean $useAc Whether to use access control or not.
	 *
	 * @throws Erfurt_Exception Throws an exception if no permission, model not existing or deletion fails.
	 */
	public function deleteModel($modelIri, $useAc = true);

	/**
	 *
	 * @param string $modelIri
	 * @param string $serializationType One of:
	 *                                          - 'xml'
	 *                                          - 'n3' or 'nt'
	 * @param mixed $filename Either a string containing a absolute filename or null. In case null is given,
	 * this method returns a string containing the serialization.
	 *
	 * @return string/null
	 */
	public function exportRdf($modelIri, $serializationType = 'xml', $filename = null);

	/**
	 * Searches resources that have literal property values matching $stringSpec.
	 *
	 * @param string $stringSpec The string pattern to be matched
	 * @param string|array $graphUris One or more graph URIs to be searched
	 * @param array option array
	 */
	public function getSearchPattern($stringSpec, $graphUris, $options = array());

	/**
	 * @param boolean $withHidden Whether to return URIs of hidden graphs, too.
	 * @return array Returns an associative array, where the key is the URI of a graph and the value
	 * is true.
	 */
	public function getAvailableModels($withHidden = false);

	/**
	 * // TODO elaborate relevance
	 */
	public function getImportsClosure($modelIri, $withHiddenImports = true, $useAC = true);

	/**
	 * @param string $modelIri The IRI, which identifies the model.
	 * @param boolean $useAc Whether to use access control or not.
	 * @throws Erfurt_Store_Exception if the requested model is not available.
	 * @return Erfurt_Rdf_Model Returns an instance of Erfurt_Rdf_Model or one of its subclasses.
	 */
	public function getModel($modelIri, $useAc = true);

	/**
	 * Returns the number fo queries committed.
	 *
	 * @return int
	 */
	public function getQueryCount();

	/**
	 * Creates a new empty model instance with IRI $modelIri.
	  *
	 * @param string $modelIri
	 * @param string $baseIri
	 * @param string $type
	 * @param boolean $useAc
	 *
	 * @throws Erfurt_Store_Exception
	 *
	 * @return Erfurt_Rdf_Model
	 */
	public function getNewModel($modelIri, $baseIri = '', $type = Erfurt_Store::MODEL_TYPE_OWL, $useAc = true);

	/**
	 * Returns inferred objects in realation to a certain set of resources.
	 *
	 * Returned objects are related to objects in the closure of start resources.
	 * Said closure is calculated using hte closure property. If no closure
	 * property is specified, the object property is used instead.
	 *
	 * @todo Implement generic version and call backend implementation if applicable.
	 */
	public function getObjectsInferred($modelUri, $startResources, $objectProperty, $closureProperty = null);

	/**
	 * Returns an array of serialization formats that can be exported.
	 *
	 * @return array
	 */
	public function getSupportedExportFormats();

	/**
	 * Returns an array of serialization formats that can be imported.
	 *
	 * @return array
	 */
	public function getSupportedImportFormats();

	/**
	 *
	 * @param string $modelIri
	 * @param string $locator Either a URL or a absolute file name.
	 * @param string $type One of:
	 *                              - 'auto' => Tries to detect the type automatically in the following order:
	 *                                              1. Detect XML by XML-Header => rdf/xml
	 *                                              2. If this fails use the extension of the file
	 *                                              3. If this fails throw an exception
	 *                              - 'xml'
	 *                              - 'n3' or 'nt'
	 * @param string $locator Denotes whether $data is a local file or a URL.
	 *
	 * @throws Erfurt_Exception
	 */
	public function importRdf($modelIri, $data, $type = 'auto', $locator = Erfurt_Syntax_RdfParser::LOCATOR_FILE, $useAc = true);

	/**
	 * @param string $modelIri The Iri, which identifies the model to look for.
	 * @param boolean $useAc Whether to use access control or not.
	 *
	 * @return boolean Returns true if model exists and is available for the user ($useAc === true).
	 */
	public function isModelAvailable($modelIri, $useAc = true);

	/**
	 * Executes a SPARQL ASK query and returns a boolean result value.
	 *
	 * @param string $modelIri
	 * @param string $askSparql
	 * @param boolean $useAc Whether to check for access control.
	 */
	public function sparqlAsk(Erfurt_Sparql_SimpleQuery $queryObject, $useAc = true);

	/**
	 * @param Erfurt_Sparql_SimpleQuery $queryObject
	 * @param string $resultFormat Currently supported are: 'plain' and 'xml'
	 * @param boolean $useAc Whether to check for access control or not.
	 *
	 * @throws Erfurt_Exception Throws an exception if query is no string.
	 *
	 * @return mixed Returns a result depending on the query, e.g. an array or a boolean value.
	 */
	public function sparqlQuery($queryObject, $options = array());

	/**
	 * Get the configuration for a graph.
	 * @param string $graphUri to specity the graph
	 * @return array
	 */
	public function getGraphConfiguration($graphUri);

	/**
	 * Counts all statements that match the SPARQL graph pattern $whereSpec.
	 *
	 * @param string $graphUri
	 * @param string $whereSpec
	 */
	public function countWhereMatches($graphIri, $whereSpec, $countSpec, $distinct = false);

	/**
	 * Returns the class name of the currently used backend.
	 *
	 * @return string
	 */
	public function getBackendName();

	/**
	 * Returns a list of graph URIs, where each graph in the list contains at least
	 * one statement where the given resource URI is used as a subject.
	 *
	 * @param string $resourceUri
	 * @return array
	 */
	public function getGraphsUsingResource($resourceUri, $useAc = true);

	/**
	 * Calculates the transitive closure for a given property and a set of starting nodes.
	 *
	 * The inverse mode (which is enabled by default) can be used to calculate the
	 * rdfs:subClassOf closure of a set of starting classes.
	 * By default this method uses a private SPARQL implementation to actually query and
	 * calculate the closure. Adapters can (and should!) provide their own implementation.
	 *
	 * @param string $propertyIri The property's IRI for which hte closure should be calculated
	 * @param array $startResources An array of resources as starting nodes
	 * @param boolean $inverse Denotes whether the property is inverse, i.e. ?child ?property ?parent
	 * @param int $maxDepth The maximum number of iteration steps
	 */
	public function getTransitiveClosure($modelIri, $property, $startResources, $inverse = true, $maxDepth = self::MAX_ITERATIONS);

}
