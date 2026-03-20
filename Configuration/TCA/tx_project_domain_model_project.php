<?php

declare(strict_types=1);

return [
    'ctrl' => [
        'title' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_project',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,description',
        'iconfile' => 'EXT:project/Resources/Public/Icons/tx_project_domain_model_project.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => 'title,description,status,responsible_members,categories,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,hidden',
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
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_project.title',
            'config' => [
                'type' => 'input',
                'size' => 50,
                'max' => 255,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'description' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_project.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'rows' => 10,
            ],
        ],
        'status' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_project.status',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_project.status.active', 'value' => 'active'],
                    ['label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_project.status.planned', 'value' => 'planned'],
                    ['label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_project.status.completed', 'value' => 'completed'],
                    ['label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_project.status.archived', 'value' => 'archived'],
                ],
                'default' => 'active',
            ],
        ],
        'responsible_members' => [
            'exclude' => false,
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_project.responsible_members',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'fe_users',
                'MM' => 'tx_project_project_feuser_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'multiple' => 0,
            ],
        ],
        'categories' => [
            'label' => 'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:tx_project_domain_model_project.categories',
            'config' => [
                'type' => 'category',
            ],
        ],
    ],
];
