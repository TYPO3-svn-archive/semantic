<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Jochen Rau <jochen.rau@typoplanet.de>
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

class Tx_Semantic_Tests_Unit_Domain_Model_Sparql_QueryResultParserTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 * @test
	 */
	public function parserParsesASimpleXmlDocument() {
		$document = '<?xml version="1.0"?>
			<sparql xmlns="http://www.w3.org/2005/sparql-results#">
			  <head>
				<variable name="x"/>
				<variable name="hpage"/>
				<variable name="name"/>
				<variable name="age"/>
				<variable name="mbox"/>
				<variable name="friend"/>
			  </head>
			  <results>
				<result> 
				  <binding name="x">
					<bnode>r2</bnode>
				  </binding>
				  <binding name="hpage">
					<uri>http://work.example.org/bob/</uri>
				  </binding>
				  <binding name="name">
					<literal xml:lang="en">Bob</literal>
				  </binding>
				  <binding name="age">
					<literal datatype="http://www.w3.org/2001/XMLSchema#integer">30</literal>
				  </binding>
				  <binding name="mbox">
					<uri>mailto:bob@work.example.org</uri>
				  </binding>
				</result>
			  </results>
			</sparql>';
		$expected = array(
			'variables' => array('x', 'hpage', 'name', 'age', 'mbox', 'friend'),
			'results' => array(array(
				'x' => array('name' => 'x', 'value' => 'r2', 'type' => 'bnode'),
				'hpage'	=> array('name' => 'hpage', 'value' => 'http://work.example.org/bob/', 'type' => 'uri'),
				'name' => array('name' => 'name', 'value' => 'Bob', 'type' => 'literal', 'language' => 'en'),
				'age' => array('name' => 'age', 'value' => '30', 'type' => 'literal', 'datatype' => 'http://www.w3.org/2001/XMLSchema#integer'),
				'mbox' => array('name' => 'mbox', 'value' => 'mailto:bob@work.example.org', 'type' => 'uri')
				))
			);
		$parser = new Tx_Semantic_Domain_Model_Sparql_QueryResultParser();
		$result = $parser->parse($document);
		$this->assertEquals($result, $expected);
	}

	/**
	 * @test
     * @expectedException Tx_Semantic_Domain_Model_Sparql_Exception_QueryResultParserException
	 */
	public function parserThrowsExceptionIfAParsingErrorOccured() {
		$document = '<foo></bar>';
		$parser = new Tx_Semantic_Domain_Model_Sparql_QueryResultParser();
		$result = $parser->parse($document);
	}


}
?>