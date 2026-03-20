<?php

declare(strict_types=1);

use Maispace\MaiProject\Controller\EventController;
use Maispace\MaiProject\Controller\EventRegistrationController;
use Maispace\MaiProject\Controller\ProjectController;

defined('TYPO3') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'MaiProject',
    'ProjectList',
    [ProjectController::class => 'list,show'],
    [],
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'MaiProject',
    'EventList',
    [EventController::class => 'list,show'],
    [],
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'MaiProject',
    'EventRegistration',
    [EventRegistrationController::class => 'form,register,cancel,participantList'],
    [EventRegistrationController::class => 'form,register,cancel'],
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
