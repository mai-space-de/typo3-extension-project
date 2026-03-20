<?php

declare(strict_types=1);

namespace Maispace\Project\Event;

use Maispace\Project\Domain\Model\EventRegistration;

/**
 * PSR-14 event dispatched when a user cancels their event registration.
 * Consumed by maispace/notify for notification purposes.
 */
final class EventCancelledEvent
{
    public function __construct(
        private readonly EventRegistration $registration
    ) {}

    public function getRegistration(): EventRegistration
    {
        return $this->registration;
    }
}
