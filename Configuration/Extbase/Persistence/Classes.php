<?php

declare(strict_types=1);

return [
    \Maispace\Project\Domain\Model\Project::class => [
        'tableName' => 'tx_project_domain_model_project',
        'properties' => [
            'responsibleMembers' => [
                'fieldName' => 'responsible_members',
            ],
        ],
    ],
    \Maispace\Project\Domain\Model\Event::class => [
        'tableName' => 'tx_project_domain_model_event',
        'properties' => [
            'eventDate' => [
                'fieldName' => 'event_date',
            ],
            'eventEndDate' => [
                'fieldName' => 'event_end_date',
            ],
            'participantLimit' => [
                'fieldName' => 'participant_limit',
            ],
            'registrationEnabled' => [
                'fieldName' => 'registration_enabled',
            ],
            'registrationDeadline' => [
                'fieldName' => 'registration_deadline',
            ],
        ],
    ],
    \Maispace\Project\Domain\Model\EventRegistration::class => [
        'tableName' => 'tx_project_domain_model_eventregistration',
        'properties' => [
            'feUser' => [
                'fieldName' => 'fe_user',
            ],
            'reminderSent' => [
                'fieldName' => 'reminder_sent',
            ],
        ],
    ],
];
