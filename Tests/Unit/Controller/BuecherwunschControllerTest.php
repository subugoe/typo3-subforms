<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
 *
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
 * Test case for class Tx_Subforms_Controller_BuecherwunschController
 *
 * @author Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
 */
class Tx_Subforms_Controller_BuecherwunschControllerTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_Subforms_Controller_BuecherwunschController
	 */
	protected $fixture;

	/**
	 * @var Tx_Subforms_Domain_Repository_BuecherwunschRepository
	 */
	protected $repository;

	/**
	 * @return void
	 */
	public function setUp() {
		$class =  'Tx_Subforms_Controller_BuecherwunschController';
		$this->fixture = $this->getMock($class, array('sendEmailThanks'),array(), '', FALSE);

		/**
		 * @var $repository Tx_Subtabs_Domain_Repository_FaecherRepository
		 */
		$this->repository = $this->getMock(
			'Tx_Subforms_Domain_Repository_BuecherwunschRepository',
			array('findAll', 'findByUid', 'update', 'add', 'remove', 'countAll')
		);

	}

	/**
	 * @test
	 */
	public function testFachAnlage(){

		print_r($this->fixture);

		$i = 1;
		
		$this->assertEquals(1, $i);
	}

}

?>