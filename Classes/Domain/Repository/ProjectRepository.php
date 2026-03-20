<?php

declare(strict_types=1);

namespace Maispace\Project\Domain\Repository;

use Maispace\Project\Domain\Model\Project;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * @extends Repository<Project>
 */
class ProjectRepository extends Repository
{
    protected $defaultOrderings = [
        'title' => QueryInterface::ORDER_ASCENDING,
    ];

    public function findByStatus(string $status): \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching($query->equals('status', $status));
        return $query->execute();
    }

    public function findActive(): \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        return $this->findByStatus(Project::STATUS_ACTIVE);
    }
}
