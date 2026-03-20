<?php

declare(strict_types=1);

defined('TYPO3') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Project',
    'ProjectList',
    'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:plugin.projectlist.title',
    'EXT:project/Resources/Public/Icons/Extension.svg'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Project',
    'EventList',
    'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:plugin.eventlist.title',
    'EXT:project/Resources/Public/Icons/Extension.svg'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Project',
    'EventRegistration',
    'LLL:EXT:project/Resources/Private/Language/locallang_db.xlf:plugin.eventregistration.title',
    'EXT:project/Resources/Public/Icons/Extension.svg'
);
