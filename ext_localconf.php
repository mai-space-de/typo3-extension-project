<?php

declare(strict_types=1);

use Maispace\Project\Controller\EventController;
use Maispace\Project\Controller\EventRegistrationController;
use Maispace\Project\Controller\ProjectController;

defined('TYPO3') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Project',
    'ProjectList',
    [ProjectController::class => 'list,show'],
    [],
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Project',
    'EventList',
    [EventController::class => 'list,show'],
    [],
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Project',
    'EventRegistration',
    [EventRegistrationController::class => 'form,register,cancel,participantList'],
    [EventRegistrationController::class => 'form,register,cancel'],
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
