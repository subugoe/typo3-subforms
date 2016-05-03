<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// TCA Buecherwunsch Form
$TCA['tx_subforms_domain_model_buecherwunsch'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.formTitle',
        'label' => 'email_address',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'default_sortby' => 'ORDER BY crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/tx_subforms_domain_model_buecherwunsch.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Img/tx_subforms_domain_model_buecherwunsch.png',
        'searchFields' => 'title',
        'readOnly' => true,
        'origUid' => 't3_origuid',
    ],
];

// TCA Feedback Form
$TCA['tx_subforms_domain_model_feedback'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_feedback.formTitle',
        'label' => 'email_address',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'languageField' => 'sys_language_uid',
        'default_sortby' => 'ORDER BY crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/tx_subforms_domain_model_feedback.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Img/tx_subforms_domain_model_feedback.png',
        'searchFields' => 'email_address',
        'readOnly' => true,
    ],
];


// Configuration
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'Forms');

// Buecherwunsch Plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('Subugoe.' . $_EXTKEY, 'Buecherwunsch',
    'Formular Buecherwunsch');

// Feedback Plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('Subugoe.' . $_EXTKEY, 'Feedback', 'Formular Feedback');

// Feedback Plugin
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin('Subugoe.' . $_EXTKEY, 'Fragdiesub',
    'Formular Frag die Sub');
