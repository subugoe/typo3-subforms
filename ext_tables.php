<?php

if (!defined('TYPO3_MODE'))
	die('Access denied.');

	// TCA Buecherwunsch Form
$TCA['tx_subforms_domain_model_buecherwunsch'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.formTitle',
		'label' => 'email_address',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField' => 'sys_language_uid',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tx_subforms_domain_model_buecherwunsch.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Img/tx_subforms_domain_model_buecherwunsch.png',
		'searchFields' => 'title',
		'readOnly' => TRUE,
		'origUid' => 't3_origuid',
	),
);

	// TCA Feedback Form
$TCA['tx_subforms_domain_model_feedback'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_feedback.formTitle',
		'label' => 'email_address',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField' => 'sys_language_uid',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tx_subforms_domain_model_feedback.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Img/tx_subforms_domain_model_feedback.png',
		'searchFields' => 'email_address',
		'readOnly' => TRUE,
	),
);



	// Configuration
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'Forms');

	// Buecherwunsch Plugin
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Buecherwunsch', 'Formular Buecherwunsch');

	// Feedback Plugin
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Feedback', 'Formular Feedback');

	// Feedback Plugin
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Fragdiesub', 'Formular Frag die Sub');

?>