<?php
declare(ENCODING = 'utf-8') ;
namespace T3\Semantic\Authentication;
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
 * Extends the Zend_Auth class in order to provide some additional functionality.
 *
 * @package $PACKAGE$
 * @subpackage $SUBPACKAGE$
 * @scope singleton
 */
class Authentication extends \Zend_Auth implements \t3lib_Singleton {

	/**
	 * Make the new operator accessible again
	 * @return void
	 */
	public function __construct() {

	}

	public function setIdentity(Zend_Auth_Result $authResult) {
		if ($authResult->isValid()) {
			$this->getStorage()->write($authResult->getIdentity());
		}
	}

	public function setUsername($newUsername) {
		$storage = $this->getStorage();
		if ($storage->isEmpty()) {
			return;
		}
		$identity = $storage->read();
		$identity->setUsername($newUsername);
		$storage->write($identity);
	}

	public function setEmail($newEmail) {
		$storage = $this->getStorage();
		if ($storage->isEmpty()) {
			return;
		}
		$identity = $storage->read();
		$identity->setEmail($newEmail);
		$storage->write($identity);
	}
}
