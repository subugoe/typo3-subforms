<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$TCA['tx_subforms_domain_model_feedback'] = [
    'ctrl' => $TCA['tx_subforms_domain_model_feedback']['ctrl'],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid,hidden,crdate,page_id,email_address,message'
    ],
    'feInterface' => $TCA['tx_subforms_domain_model_feedback']['feInterface'],
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
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_feedback.crdate',
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
        'page_id' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_feedback.pageId',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'email_address' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_feedback.emailAddress',
            'config' => [
                'type' => 'input',
                'size' => '30',
                'eval' => 'trim',
            ]
        ],
        'message' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:subforms/Resources/Private/Language/locallang_db.xml:tx_subforms_domain_model_feedback.message',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'sys_language_uid;;;;1-1-1, hidden;;1,crdate,page_id,email_address,message'],
    ],
    'palettes' => [
        '1' => ['showitem' => '']
    ]
];
