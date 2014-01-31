<?php
if (!defined('TYPO3_MODE'))
	die('Access denied.');

$TCA['tx_subforms_domain_model_buecherwunsch'] = array(
	'ctrl' => $TCA['tx_subforms_domain_model_buecherwunsch']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,crdate,title,author,editor,publishing_year,issue,isbn,additional_data,name,user_id,email_address,needed_for,deadline,faculty,institute_name,remarks'
	),
	'feInterface' => $TCA['tx_subforms_domain_model_buecherwunsch']['feInterface'],
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'crdate' => Array (
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.crdate',
			'config' => Array (
				'type' => 'input',
				'size' => '8',
				'max' => '20',
				'eval' => 'datetime',
				'checkbox' => '0',
				'default' => '0',
				'range' => Array (
					'upper' => mktime(0,0,0,12,31,2020),
					'lower' => mktime(0,0,0,date('m')-1,date('d'),date('Y'))
				)
			)
		),
		'titel' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.title',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'author' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.author',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			),
		),
		'editor' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.editor',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'publishing_year' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.publishingYear',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'issue' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.issue',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'isbn' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.isbn',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'additional_data' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.additionalData',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.name',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'user_id' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.userId',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'email_address' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.emailAddress',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'needed_for' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.neededFor',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'deadline' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.deadline',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'tutor' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.tutor',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'faculty' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.faculty',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'institute_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.instituteName',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'trim',
			)
		),
		'remarks' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.remarks',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
	),
	'types' => array(
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,crdate,title,author,editor,publishing_year,issue,isbn,additional_data,name,user_id,email_address,needed_for,deadline,faculty,institute_name,remarks'),
	),
	'palettes' => array(
		'1' => array('showitem' => '')
	)
	);

?>