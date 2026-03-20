<?php

declare(strict_types=1);

namespace Maispace\Project\Domain\Repository;

use Maispace\Project\Domain\Model\Event;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * @extends Repository<Event>
 */
class EventRepository extends Repository
{
    protected $defaultOrderings = [
        'eventDate' => QueryInterface::ORDER_ASCENDING,
    ];

    public function findUpcoming(): \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->greaterThanOrEqual('eventDate', new \DateTime())
        );
        return $query->execute();
    }

    public function findByProject(\Maispace\Project\Domain\Model\Project $project): \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching($query->equals('project', $project));
        return $query->execute();
    }
}
