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

class Tx_Semantic_Domain_Repository_Rdf_StatementRepositoryTest extends Tx_Extbase_Tests_Unit_BaseTestCase {

	/**
	 * @test
	 */
	public function getConstraintsForArgumentsGetsInvoked() {
		$mockRepository = $this->getAccessibleMock('Tx_Semantic_Domain_Repository_Rdf_StatementRepository', array('getConstraintsForArguments'));
		$mockRepository->expects($this->once())->method('getConstraintsForArguments')->with(array('foo', 'bar', 'baz'));
		$mockRepository->findByGraphPattern('foo', 'bar', 'baz');
	}

	/**
	 * @test
	 */
	public function parseSingleTripleGetsInvoked() {
		$mockRepository = $this->getAccessibleMock('Tx_Semantic_Domain_Repository_Rdf_StatementRepository', array('parseSingleTriple'));
		$mockRepository->expects($this->once())->method('parseSingleTriple');
		$mockRepository->getConstraintsForArguments(array('foo', 'bar', NULL));
	}

	/**
	 * @test
	 */
	public function parseMultipleTriplesGetsInvoked() {
		$mockRepository = $this->getAccessibleMock('Tx_Semantic_Domain_Repository_Rdf_StatementRepository', array('parseSingleTriple'));
		$mockRepository->expects($this->once())->method('getConstraintsForArguments')->with(array('boo', 'baa', 'buu'));
		$mockRepository->getConstraintsForArguments(array('boo', 'baa', 'buu'), array('baz', 'boom', 'blub'));
	}

	/**
	 * @test
	 * @expectedException Tx_Semantic_Exception
	 */
	public function aWrongNumberOfSingleArgumentsResultsInAnException() {
		$mockRepository = $this->getAccessibleMock('Tx_Semantic_Domain_Repository_Rdf_StatementRepository', array('parseSingleTriple'));
		$mockRepository->getConstraintsForArguments('foo', 'bar');
	}

}
?>