<?php

declare(strict_types=1);

namespace Maispace\Project\Tests\Unit\Domain\Model;

use Maispace\Project\Domain\Model\Project;
use PHPUnit\Framework\TestCase;
use Maispace\Project\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class ProjectTest extends TestCase
{
    private Project $subject;

    protected function setUp(): void
    {
        $this->subject = new Project();
    }

    public function testInitialTitleIsEmpty(): void
    {
        self::assertSame('', $this->subject->getTitle());
    }

    public function testSetTitle(): void
    {
        $this->subject->setTitle('Test Project');
        self::assertSame('Test Project', $this->subject->getTitle());
    }

    public function testInitialDescriptionIsEmpty(): void
    {
        self::assertSame('', $this->subject->getDescription());
    }

    public function testSetDescription(): void
    {
        $this->subject->setDescription('Test description');
        self::assertSame('Test description', $this->subject->getDescription());
    }

    public function testInitialStatusIsActive(): void
    {
        self::assertSame(Project::STATUS_ACTIVE, $this->subject->getStatus());
    }

    public function testSetStatus(): void
    {
        $this->subject->setStatus(Project::STATUS_COMPLETED);
        self::assertSame(Project::STATUS_COMPLETED, $this->subject->getStatus());
    }

    public function testInitialResponsibleMembersIsEmptyObjectStorage(): void
    {
        self::assertInstanceOf(ObjectStorage::class, $this->subject->getResponsibleMembers());
        self::assertCount(0, $this->subject->getResponsibleMembers());
    }

    public function testAddAndRemoveResponsibleMember(): void
    {
        $member = new FrontendUser();
        $this->subject->addResponsibleMember($member);
        self::assertCount(1, $this->subject->getResponsibleMembers());

        $this->subject->removeResponsibleMember($member);
        self::assertCount(0, $this->subject->getResponsibleMembers());
    }
}
