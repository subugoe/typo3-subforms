<?php
namespace Subugoe\Subforms\Domain\Validator;
/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>
 *      Goettingen State Library
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * ************************************************************* */

/**
 * Validator to determine if a string is either empty or contains a valid E-Mail address
 */
class EmptyOrEmailValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

	/**
	 * Validates an incoming string that either has to contain a valid E-Mail address or to be empty
	 *
	 * @param string $email
	 * @return bool
	 */
	public function isValid($email){

		if (empty($email)) {
			return TRUE;
		} else {
			 if (self::verify($email) === TRUE) {
				return TRUE;
			 } else {
				$this->addError('Please enter a valid E-Mail address', 1334831981);
				return FALSE;
			 }
		}
	}

	/**
	 * Copied from Extbase Validator
	 *
	 * @param $value
	 * @return bool
	 */
	protected function verify($value) {
		if(is_string($value) && preg_match('
				/^
					[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*
					@
					(?:
						(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[a-z]{2}|aero|asia|biz|cat|com|edu|coop|gov|info|int|invalid|jobs|localdomain|mil|mobi|museum|name|net|org|pro|tel|travel)|
						localhost|
						(?:(?:\d{1,2}|1\d{1,2}|2[0-4][0-9]|25[0-5])\.){3}(?:(?:\d{1,2}|1\d{1,2}|2[0-4][0-9]|25[0-5]))
					)
				$/Dix', $value)) {
			return TRUE;
		}
		return FALSE;
	}

}
