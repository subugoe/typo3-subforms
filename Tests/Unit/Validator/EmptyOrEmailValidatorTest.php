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
 * Test case for class Tx_Subforms_Domain_Validator_EmptyOrEmailValidator
 *
 * @author Ingo Pfennigstorf <pfennigstorf@sub.uni-goettingen.de>
 */
class Tx_Subforms_Controller_BuecherwunschControllerTest extends Tx_Extbase_Tests_Unit_BaseTestCase
{
    protected $validatorClassName = 'Tx_Subforms_Domain_Validator_EmptyOrEmailValidator';

    /**
     *
     * @var Tx_Extbase_Validation_Validator_ValidatorInterface
     */
    protected $validator;

    public function setUp()
    {
        $this->validator = $this->getValidator();
    }

    protected function getValidator($options = [])
    {
        $validator = new $this->validatorClassName($options);
        return $validator;
    }

    /**
     * @test
     */
    public function emailOrEmptyValidatorDoesNotThrowAnErrorForAnEmptyString()
    {
        $this->assertFalse($this->validator->validate("")->hasErrors());
    }

    /**
     * @test
     */
    public function emailOrEmptyValidatorDoesNotThrowAnErrorForAValidEmailAddress()
    {
        $this->assertFalse($this->validator->validate('i.pfennigstorf@gmail.com')->hasErrors());
    }

    /**
     * @test
     */
    public function emailOrEmptyValidatorThrowsAnErrorOnNonEmailAddresses()
    {
        $this->assertTrue($this->validator->validate('pfennigstorf')->hasErrors());
    }

    protected function validatorOptions($options)
    {
        $this->validator = $this->getValidator($options);
    }
}
