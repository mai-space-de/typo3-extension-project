<?php

declare(strict_types=1);

namespace Maispace\Project\Domain\Repository;

use Maispace\Project\Domain\Model\Event;
use Maispace\Project\Domain\Model\EventRegistration;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * @extends Repository<EventRegistration>
 */
class EventRegistrationRepository extends Repository
{
    public function findByEventAndUser(Event $event, FrontendUser $feUser): ?\Maispace\Project\Domain\Model\EventRegistration
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('event', $event),
                $query->equals('feUser', $feUser)
            )
        );
        return $query->execute()->getFirst();
    }

    public function findByEvent(Event $event): \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching($query->equals('event', $event));
        return $query->execute();
    }

    public function countConfirmedByEvent(Event $event): int
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('event', $event),
                $query->equals('status', EventRegistration::STATUS_REGISTERED)
            )
        );
        return $query->execute()->count();
    }

    public function findWaitlistedByEvent(Event $event): \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals('event', $event),
                $query->equals('status', EventRegistration::STATUS_WAITLISTED)
            )
        );
        return $query->execute();
    }
}
