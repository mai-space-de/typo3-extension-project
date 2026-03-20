<?php

declare(strict_types=1);

namespace Maispace\MaiProject\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use Maispace\MaiProject\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Project extends AbstractEntity
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_ARCHIVED = 'archived';
    public const STATUS_PLANNED = 'planned';

    protected string $title = '';
    protected string $description = '';
    protected string $status = self::STATUS_ACTIVE;

    /**
     * @var ObjectStorage<FrontendUser>
     */
    #[Lazy]
    protected ObjectStorage $responsibleMembers;

    /**
     * @var ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    #[Lazy]
    protected ObjectStorage $categories;

    public function __construct()
    {
        $this->responsibleMembers = new ObjectStorage();
        $this->categories = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getResponsibleMembers(): ObjectStorage
    {
        return $this->responsibleMembers;
    }

    public function setResponsibleMembers(ObjectStorage $responsibleMembers): void
    {
        $this->responsibleMembers = $responsibleMembers;
    }

    public function addResponsibleMember(FrontendUser $member): void
    {
        $this->responsibleMembers->attach($member);
    }

    public function removeResponsibleMember(FrontendUser $member): void
    {
        $this->responsibleMembers->detach($member);
    }

    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    public function setCategories(ObjectStorage $categories): void
    {
        $this->categories = $categories;
    }

    public function addCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category): void
    {
        $this->categories->attach($category);
    }

    public function removeCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category): void
    {
        $this->categories->detach($category);
    }
}
