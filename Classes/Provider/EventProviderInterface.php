<?php

declare(strict_types=1);

namespace Maispace\Project\Provider;

use Maispace\Project\Domain\Model\Event;

/**
 * Interface for providing event data to external consumers like maispace/calendar.
 */
interface EventProviderInterface
{
    /**
     * Returns all upcoming events.
     *
     * @return iterable<Event>
     */
    public function getUpcomingEvents(): iterable;

    /**
     * Returns events within a date range.
     *
     * @return iterable<Event>
     */
    public function getEventsByDateRange(\DateTimeImmutable $from, \DateTimeImmutable $to): iterable;

    /**
     * Returns a single event by its UID.
     */
    public function getEventByUid(int $uid): ?Event;
}
