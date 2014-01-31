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
 * Controller for the Feedback form used on sub.uni-goettingen.de
 * $Id: FeedbackController.php 1994 2012-12-05 14:44:42Z pfennigstorf $
 * @author Ingo Pfennigstorf <pfennigstorf@sub-goettingen.de>, Goettingen State Library
 */
class Tx_Subforms_Controller_FeedbackController extends Tx_Subforms_Controller_FormController {

	/**
	 * @var Tx_Subforms_Domain_Model_Feedback
	 * @inject
	 */
	protected $feedbackModel;

	/**
	 * @var Tx_Subforms_Domain_Repository_FeedbackRepository
	 * @inject
	 */
	protected $feedbackRepository;

	/**
	 * @var Tx_Subforms_Domain_Repository_PageRepository
	 * @inject
	 */
	protected $pageRepository;

	/**
	 * Initializes some defaults
	 */
	public function initializeAction() {
		parent::initializeAction();
		$this->receiver = $this->settings['mail']['feedback']['toMail'];
		$this->sender =  $this->settings['mail']['feedback']['fromMail'];
		$this->subject = 'Feedback';
	}

	/**
	 * Displays the form
	 *
	 * @param Tx_Subforms_Domain_Model_Feedback $feedback
	 * @dontvalidate $feedback
	 */
	public function indexAction(Tx_Subforms_Domain_Model_Feedback $feedback = NULL) {
		parent::indexAction();

		if ($feedback === NULL) {
			$feedback = $this->feedbackModel;
		}
		if ($this->request->hasArgument('pageId')) {
			$pageId = intval($this->request->getArgument('pageId'));
			$feedback->setPageId($pageId);
			$page = $this->pageRepository->findByUid($pageId);
			$this->view->assign('page', $page);
		}
		$this->view->assign('feedback', $feedback);
	}

	/**
	 * Creates the Feedback and triggers the E-Mail sending
	 *
	 * @param Tx_Subforms_Domain_Model_Feedback $feedback
	 * @return void
	 */
	public function createAction(Tx_Subforms_Domain_Model_Feedback $feedback) {
		parent::createAction($feedback);
		$this->feedbackRepository->add($feedback);
	}

}