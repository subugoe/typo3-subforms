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
 * $Id: FormController.php 2049 2012-12-18 07:53:23Z pfennigstorf $
 * @author Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>, Goettingen State Library
 */
class Tx_Subforms_Controller_FormController extends Tx_Extbase_MVC_Controller_ActionController {

	const extKey = 'subforms';

	/**
	 * @var string
	 */
	protected $receiver;

	/**
	 * @var array
	 */
	protected $sender;

	/**
	 * @var string
	 */
	protected $subject;

	/**
	 * @var string
	 */
	protected $modelName;

	/**
	 * @var string
	 */
	protected $repositoryName;

	/**
	 * @var string
	 */
	protected $controllerName;

	/**
	 * Do some magic and initiate variables used in subclasses
	 *
	 * @return void
	 */
	public function initializeAction() {

		$controller = $this->request->getControllerObjectName();

			// get the controller name for use as part of the  template path
		$this->controllerName = $this->request->getControllerName();
		$action = $this->request->getControllerActionName();

			// get model for the form
		$methodParams = $this->reflectionService->getMethodTagsValues($controller, $action . 'Action');
		$model = explode(' ', $methodParams['param'][0]);
		$this->modelName = $model[0];

			// create repository
		$this->repositoryName = str_replace('Model', 'Repository', $this->modelName) . 'Repository';

	}

	/**
	 * Placeholder for indexAction
	 */
	public function indexAction() {

	}

	/**
	 * Adds data to the repository, triggers mail sending and gives a feedback to the front end user
	 *
	 * @param $values An object to insert into the repository
	 * @dontvalidate
	 */
	public function createAction($values) {

		$lowerCaseModel = strtolower($this->modelName);

				// add to repository
		if (self::sendEmail($values)) {
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate($lowerCaseModel . '.thankYou', self::extKey, t3lib_FlashMessage::OK));
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate($lowerCaseModel . '.thankYouText', self::extKey, t3lib_FlashMessage::OK));
		} else {
			$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_subforms.error', self::extKey, t3lib_FlashMessage::ERROR));
		}

		$this->redirect('index');
	}

	/**
	 * @param mixed $values
	 * @return boolean TRUE on success, otherwise false
	 */
	protected function sendEmail($values) {

			// E-Mail to recipient (internal)
		$emailView = $this->objectManager->create('Tx_Fluid_View_StandaloneView');
		$emailView->setFormat('text');
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['settings']['view']['templateRootPath']);
		$templatePathAndFilename = $templateRootPath . $this->controllerName . '/Email.html';
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);

			// add variables to template
		$emailView->assign('values', $values);

		$emailBody = $emailView->render();
		$message = t3lib_div::makeInstance('t3lib_mail_Message');
		$message->setTo($this->receiver)
				->setFrom($this->sender)
				->setSubject($this->subject);

			// Plain text example
		$message->setBody($emailBody, 'text/plain');

		$message->send();
		return $message->isSent();
	}

}