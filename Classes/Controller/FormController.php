<?php
namespace Subugoe\Subforms\Controller;
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
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Main conrtroller for subforms extension
 */
class FormController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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

		/** @var \TYPO3\CMS\Core\Page\PageRenderer $pageRenderer */
		$pageRenderer = $GLOBALS['TSFE']->getPageRenderer();
		$pageRenderer->addCssFile(ExtensionManagementUtility::siteRelPath('subforms') . 'Resources/Public/Css/subforms.css');
		$pageRenderer->addJsFile(ExtensionManagementUtility::siteRelPath('subforms') . 'Resources/Public/JavaScript/SubForms.js');

		$controller = $this->request->getControllerObjectName();

		// get the controller name for use as part of the  template path
		$this->controllerName = $this->request->getControllerName();
		$action = $this->request->getControllerActionName();

		// get model for the form
		$methodParams = $this->reflectionService->getMethodTagsValues($controller, $action . 'Action');
		$model = explode(' ', $methodParams['param'][0]);

		$modelParts = explode('\\', $model[0]);

		$this->modelName = $modelParts[5];

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
	 * @param void
	 * @ignorevalidation
	 */
	public function createAction($values) {

		$lowerCaseModel = 'tx_subforms_domain_model_' . strtolower($this->modelName);

		// add to repository
		if (self::sendEmail($values)) {
			$this->addFlashMessage(LocalizationUtility::translate($lowerCaseModel . '.thankYou', self::extKey), '', FlashMessage::OK);
			$this->addFlashMessage(LocalizationUtility::translate($lowerCaseModel . '.thankYouText', self::extKey), '', FlashMessage::OK);
		} else {
			$this->addFlashMessage(LocalizationUtility::translate('tx_subforms.error', self::extKey, '', FlashMessage::ERROR));
		}

		$this->redirect('index');
	}

	/**
	 * @param mixed $values
	 * @return boolean TRUE on success, otherwise false
	 */
	protected function sendEmail($values) {

		// E-Mail to recipient (internal)
		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
		$emailView = $this->objectManager->get(\TYPO3\CMS\Fluid\View\StandaloneView::class);
		$emailView->setFormat('text');
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['settings']['view']['templateRootPath']);
		$templatePathAndFilename = $templateRootPath . $this->controllerName . '/Email.html';
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);

		// add variables to template
		$emailView->assign('values', $values);

		$emailBody = $emailView->render();
		/** @var \TYPO3\CMS\Core\Mail\MailMessage $message */
		$message = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
		$message->setTo($this->receiver)
				->setFrom($this->sender)
				->setSubject($this->subject);

		// Plain text example
		$message->setBody($emailBody, 'text/plain');

		$message->send();
		return $message->isSent();
	}

}
