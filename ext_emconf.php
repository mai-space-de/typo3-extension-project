<?php

// $_EXTKEY is set to the extension key ('project') by TYPO3 when this file is loaded.
$EM_CONF[$_EXTKEY] = [
    'title' => 'maispace: Project & Events',
    'description' => 'Manage projects, events, and event registrations',
    'category' => 'plugin',
    'author' => 'maispace',
    'author_email' => '',
    'state' => 'beta',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-12.99.99',
            'extbase' => '12.4.0-12.99.99',
            'fluid' => '12.4.0-12.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
