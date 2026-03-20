<?php

declare(strict_types=1);

defined('TYPO3') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MaiProject',
    'ProjectList',
    'LLL:EXT:mai_project/Resources/Private/Language/locallang_db.xlf:plugin.projectlist.title',
    'EXT:mai_project/Resources/Public/Icons/Extension.svg'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MaiProject',
    'EventList',
    'LLL:EXT:mai_project/Resources/Private/Language/locallang_db.xlf:plugin.eventlist.title',
    'EXT:mai_project/Resources/Public/Icons/Extension.svg'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'MaiProject',
    'EventRegistration',
    'LLL:EXT:mai_project/Resources/Private/Language/locallang_db.xlf:plugin.eventregistration.title',
    'EXT:mai_project/Resources/Public/Icons/Extension.svg'
);
