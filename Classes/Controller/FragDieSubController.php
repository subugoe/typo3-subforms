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

/**
 * Controller for the Frag die Sub form used on sub.uni-goettingen.de
 */
class FragDieSubController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * @var \Subugoe\Subforms\Domain\Model\FragDieSub
     */
    protected $feedbackmodel;

    /**
     * @var Tx_Subforms_Domain_Repository_FeedbackRepository
     */
    protected $feedbackRepository;

    /**
     * @param \Subugoe\Subforms\Domain\Model\FragDieSub $feedbackmodel
     */
    public function injectFeedbackModel(\Subugoe\Subforms\Domain\Model\FragDieSub $feedbackmodel)
    {
        $this->feedbackmodel = $feedbackmodel;
    }

    /**
     * @param Tx_Subforms_Domain_Repository_FeedbackRepository $feedbackRepository
     */
    public function injectFeedbackRepository(Tx_Subforms_Domain_Repository_FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * Displays the form
     *
     * @param \Subugoe\Subforms\Domain\Model\FragDieSub $feedback
     * @dontvalidate $feedback
     */
    public function indexAction(\Subugoe\Subforms\Domain\Model\FragDieSub $feedback = null)
    {
        if ($feedback === null) {
            $feedback = $this->feedbackmodel;
        }

        if ($this->request->hasArgument('pageId')) {
            $feedback->setPageId($this->request->getArgument('pageId'));
        }
        $this->view->assign('feedback', $feedback);
    }

    /**
     * Creates the Feedback and triggers the E-Mail sending
     *
     * @param \Subugoe\Subforms\Domain\Model\FragDieSub $feedback
     */
    public function createAction(\Subugoe\Subforms\Domain\Model\FragDieSub $feedback)
    {
        if ($this->sendEmail($feedback)) {
            // Dem Repository hinzufuegen
            $this->feedbackRepository->add($feedback);
            $this->addFlashMessage(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_subforms_domain_model_feedback.thankYou',
                'subforms'));
            $this->addFlashMessage(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_subforms_domain_model_feedback.thankYouText',
                'subforms'));
        } else {
            $this->addFlashMessage(\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_subforms_domain_model_feedback.tx_subforms.error',
                'subforms'));
        }
        $this->redirect('index');
    }
}
