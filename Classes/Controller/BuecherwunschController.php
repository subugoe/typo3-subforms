<?php

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
 * Description
 * $Id: BuecherwunschController.php 2050 2012-12-18 08:01:21Z pfennigstorf $
 * @author Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>, Goettingen State Library
 */
class Tx_Subforms_Controller_BuecherwunschController extends Tx_Subforms_Controller_FormController {

	/**
	 * @var Tx_Subforms_Domain_Model_Buecherwunsch
	 * @inject
	 */
	protected $buecherwunschModel;

	/**
	 * @var Tx_Subforms_Domain_Repository_BuecherwunschRepository
	 * @inject
	 */
	protected $buecherwunschRepository;

	/**
	 * Initializes defaults
	 */
	public function initializeAction() {
		parent::initializeAction();
		$this->receiver = $this->settings['mail']['buecherwunsch']['toMail'];
		$this->subject = 'Feedback';
	}

	/**
	 * Displays the form
	 *
	 * @param Tx_Subforms_Domain_Model_Buecherwunsch $buecherwunsch
	 * @dontvalidate $buecherwunsch
	 */
	public function indexAction(Tx_Subforms_Domain_Model_Buecherwunsch $buecherwunsch = NULL) {
		parent::indexAction();
		if ($buecherwunsch === NULL) {
			$buecherwunsch = $this->buecherwunschModel;
		}
		$this->view->assign('buecherwunsch', $buecherwunsch);
	}

	/**
	 * Creates the Buecherwunsch and triggers the E-Mail sending
	 *
	 * @param Tx_Subforms_Domain_Model_Buecherwunsch $buecherwunsch
	 */
	public function createAction(Tx_Subforms_Domain_Model_Buecherwunsch $buecherwunsch) {

		$counter = $this->buecherwunschRepository->countAll() + $this->settings['mail']['buecherwunsch']['counterStart'];

		$this->sender =  array($buecherwunsch->getEmailAddress() => $buecherwunsch->getName());
		$this->subject = $counter . ' - Bücherwunsch';
		$this->buecherwunschRepository->add($buecherwunsch);
		if ($this->sendEmailThanks($buecherwunsch, 'EmailThanks')) {
			parent::createAction($buecherwunsch);
		}
	}

	/**
	 * @Todo generic E-Mail sender function
	 * @param Tx_Subforms_Domain_Model_Buecherwunsch $buecherwunsch
	 * @param string $template
	 * @return boolean
	 */
	protected function sendEmailThanks(Tx_Subforms_Domain_Model_Buecherwunsch $buecherwunsch, $template) {

			$receiver = $buecherwunsch->getEmailAddress();

				// E-Mail to Buecherwunsch
			$emailView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');
			$emailView->setFormat('text');
			$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
			$templateRootPath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['settings']['view']['templateRootPath']);
			$templatePathAndFilename = $templateRootPath . 'Buecherwunsch/' . $template . '.html';
			$emailView->setTemplatePathAndFilename($templatePathAndFilename);
			$emailView->assign('buecherwunsch', $buecherwunsch);
			$emailBody = $emailView->render();
			/** @var t3lib_mail_Message $message */
			$message = t3lib_div::makeInstance('t3lib_mail_Message');
			$message->setTo($receiver)
					->setFrom(array('buecherwunsch@sub.uni-goettingen.de' => 'buecherwunsch@sub.uni-goettingen.de'))
					->setSubject('Vielen Dank für Ihren Bücherwunsch');

				// Plain text example
			$message->setBody($emailBody, 'text/plain');

			$message->send();

			t3lib_div::devLog('Message ' . $message->generateId() . ' sent to ' . $receiver , 'subforms');
			return $message->isSent();
		}

}