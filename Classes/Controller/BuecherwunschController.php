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
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * BuecherwunschController
 */
class BuecherwunschController extends FormController
{

    /**
     * @var \Subugoe\Subforms\Domain\Model\Buecherwunsch
     * @inject
     */
    protected $buecherwunschModel;

    /**
     * @var \Subugoe\Subforms\Domain\Repository\BuecherwunschRepository
     * @inject
     */
    protected $buecherwunschRepository;

    /**
     * Initializes defaults
     */
    public function initializeAction()
    {
        parent::initializeAction();
        $this->receiver = $this->settings['mail']['buecherwunsch']['toMail'];
        $this->subject = 'Feedback';
    }

    /**
     * Displays the form
     *
     * @param \Subugoe\Subforms\Domain\Model\Buecherwunsch $buecherwunsch
     * @dontvalidate $buecherwunsch
     */
    public function indexAction(\Subugoe\Subforms\Domain\Model\Buecherwunsch $buecherwunsch = NULL)
    {
        parent::indexAction();
        if ($buecherwunsch === NULL) {
            $buecherwunsch = $this->buecherwunschModel;
        }
        $this->view->assign('buecherwunsch', $buecherwunsch);
    }

    /**
     * Creates the Buecherwunsch and triggers the E-Mail sending
     *
     * @param \Subugoe\Subforms\Domain\Model\Buecherwunsch $buecherwunsch
     */
    public function createAction(\Subugoe\Subforms\Domain\Model\Buecherwunsch $buecherwunsch)
    {

        $counter = $this->buecherwunschRepository->countAll() + $this->settings['mail']['buecherwunsch']['counterStart'];

        $this->sender = [$buecherwunsch->getEmailAddress() => $buecherwunsch->getName()];
        $this->subject = $counter . ' - Bücherwunsch';
        $this->buecherwunschRepository->add($buecherwunsch);
        if ($this->sendEmailThanks($buecherwunsch, 'EmailThanks')) {
            parent::createAction($buecherwunsch);
        }
    }

    /**
     * @Todo generic E-Mail sender function
     * @param \Subugoe\Subforms\Domain\Model\Buecherwunsch $buecherwunsch
     * @param string $template
     * @return boolean
     */
    protected function sendEmailThanks(\Subugoe\Subforms\Domain\Model\Buecherwunsch $buecherwunsch, $template)
    {

        $receiver = $buecherwunsch->getEmailAddress();

        // E-Mail to Buecherwunsch
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
        $emailView = $this->objectManager->get(\TYPO3\CMS\Fluid\View\StandaloneView::class);
        $emailView->setFormat('text');
        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $templateRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['settings']['view']['templateRootPath']);
        $templatePathAndFilename = $templateRootPath . 'Buecherwunsch/' . $template . '.html';
        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assign('buecherwunsch', $buecherwunsch);
        $emailBody = $emailView->render();
        /** @var \TYPO3\CMS\Core\Mail\MailMessage $message */
        $message = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
        $message->setTo($receiver)
            ->setFrom(['buecherwunsch@sub.uni-goettingen.de' => 'buecherwunsch@sub.uni-goettingen.de'])
            ->setSubject('Vielen Dank für Ihren Bücherwunsch');

        // Plain text example
        $message->setBody($emailBody, 'text/plain');

        $message->send();

        GeneralUtility::devLog('Message ' . $message->generateId() . ' sent to ' . $receiver, 'subforms');
        return $message->isSent();
    }

}
