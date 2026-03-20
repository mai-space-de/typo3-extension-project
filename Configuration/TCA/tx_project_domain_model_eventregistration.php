<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_eventregistration',
        'label' => 'fe_user',
        'label_alt' => 'event',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'iconfile' => 'EXT:project/Resources/Public/Icons/tx_project_domain_model_eventregistration.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => 'fe_user,event,status,reminder_sent,notes,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,hidden',
        ],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [['label' => '', 'invertStateDisplay' => true]],
            ],
        ],
        'fe_user' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_eventregistration.fe_user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'fe_users',
                'items' => [['label' => '', 'value' => 0]],
                'size' => 1,
                'required' => true,
            ],
        ],
        'event' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_eventregistration.event',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_project_domain_model_event',
                'items' => [['label' => '', 'value' => 0]],
                'size' => 1,
            ],
        ],
        'status' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_eventregistration.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_eventregistration.status.registered', 'value' => 'registered'],
                    ['label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_eventregistration.status.waitlisted', 'value' => 'waitlisted'],
                    ['label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_eventregistration.status.cancelled', 'value' => 'cancelled'],
                ],
                'default' => 'registered',
            ],
        ],
        'reminder_sent' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_eventregistration.reminder_sent',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [['label' => '']],
            ],
        ],
        'notes' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_eventregistration.notes',
            'config' => [
                'type' => 'text',
                'rows' => 5,
            ],
        ],
    ],
];
