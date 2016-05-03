<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_subforms_domain_model_buecherwunsch'] = [
    'ctrl' => $TCA['tx_subforms_domain_model_buecherwunsch']['ctrl'],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,crdate,title,author,editor,publishing_year,issue,isbn,additional_data,name,user_id,email_address,needed_for,deadline,faculty,institute_name,remarks'
    ],
    'feInterface' => $TCA['tx_subforms_domain_model_buecherwunsch']['feInterface'],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0]
                ]
            ]
        ],
        'crdate' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.crdate',
            'config' => [
                'type' => 'input',
                'size' => '8',
                'max' => '20',
                'eval' => 'datetime',
                'checkbox' => '0',
                'default' => '0',
                'range' => [
                    'upper' => mktime(0, 0, 0, 12, 31, 2020),
                    'lower' => mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'))
                ]
            ]
        ],
        'titel' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.title',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'author' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.author',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ],
        ],
        'editor' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.editor',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'publishing_year' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.publishingYear',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'issue' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.issue',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'isbn' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.isbn',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'additional_data' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.additionalData',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'name' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.name',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'user_id' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.userId',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'email_address' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.emailAddress',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'needed_for' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.neededFor',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'deadline' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.deadline',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'tutor' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.tutor',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'faculty' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.faculty',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'institute_name' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.instituteName',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'remarks' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_buecherwunsch.remarks',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,crdate,title,author,editor,publishing_year,issue,isbn,additional_data,name,user_id,email_address,needed_for,deadline,faculty,institute_name,remarks'],
    ],
    'palettes' => [
        '1' => ['showitem' => '']
    ]
];
