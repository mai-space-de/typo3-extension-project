<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,description,location',
        'iconfile' => 'EXT:project/Resources/Public/Icons/tx_project_domain_model_event.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => 'title,event_date,event_end_date,location,description,project,--div--;LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event.registration_tab,participant_limit,registration_enabled,registration_deadline,registrations,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,hidden',
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
        'title' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event.title',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'event_date' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event.event_date',
            'config' => [
                'type' => 'datetime',
                'required' => true,
            ],
        ],
        'event_end_date' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event.event_end_date',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'location' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event.location',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'max' => 255,
                'eval' => 'trim',
            ],
        ],
        'description' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'rows' => 10,
            ],
        ],
        'project' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event.project',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_project_domain_model_project',
                'items' => [['label' => '', 'value' => 0]],
                'size' => 1,
            ],
        ],
        'participant_limit' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event.participant_limit',
            'config' => [
                'type' => 'number',
                'size' => 4,
                'default' => 0,
            ],
        ],
        'registration_enabled' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event.registration_enabled',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [['label' => '']],
            ],
        ],
        'registration_deadline' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event.registration_deadline',
            'config' => [
                'type' => 'datetime',
            ],
        ],
        'registrations' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_event.registrations',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_project_domain_model_eventregistration',
                'foreign_field' => 'event',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => true,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1,
                ],
            ],
        ],
    ],
];
