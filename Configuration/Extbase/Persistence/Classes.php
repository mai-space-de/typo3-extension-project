<?php

declare(strict_types=1);

return [
    \Maispace\MaiProject\Domain\Model\Project::class => [
        'tableName' => 'tx_maiproject_domain_model_project',
        'properties' => [
            'responsibleMembers' => [
                'fieldName' => 'responsible_members',
            ],
        ],
    ],
    \Maispace\MaiProject\Domain\Model\Event::class => [
        'tableName' => 'tx_maiproject_domain_model_event',
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
    \Maispace\MaiProject\Domain\Model\EventRegistration::class => [
        'tableName' => 'tx_maiproject_domain_model_eventregistration',
        'properties' => [
            'feUser' => [
                'fieldName' => 'fe_user',
            ],
            'reminderSent' => [
                'fieldName' => 'reminder_sent',
            ],
        ],
    ],
    \Maispace\MaiProject\Domain\Model\FrontendUser::class => [
        'tableName' => 'fe_users',
        'properties' => [
            'firstName' => [
                'fieldName' => 'first_name',
            ],
            'lastName' => [
                'fieldName' => 'last_name',
            ],
        ],
    ],
];
