<?php

declare(strict_types=1);

namespace Maispace\MaiProject\Tests\Unit\Domain\Model;

use Maispace\MaiProject\Domain\Model\Event;
use Maispace\MaiProject\Domain\Model\EventRegistration;
use Maispace\MaiProject\Domain\Model\Project;
use PHPUnit\Framework\TestCase;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class EventTest extends TestCase
{
    private Event $subject;

    protected function setUp(): void
    {
        $this->subject = new Event();
    }

    public function testInitialTitleIsEmpty(): void
    {
        self::assertSame('', $this->subject->getTitle());
    }

    public function testSetTitle(): void
    {
        $this->subject->setTitle('Test Event');
        self::assertSame('Test Event', $this->subject->getTitle());
    }

    public function testInitialRegistrationsIsEmptyObjectStorage(): void
    {
        self::assertInstanceOf(ObjectStorage::class, $this->subject->getRegistrations());
        self::assertCount(0, $this->subject->getRegistrations());
    }

    public function testSetProject(): void
    {
        $project = new Project();
        $project->setTitle('Test Project');
        $this->subject->setProject($project);
        self::assertSame($project, $this->subject->getProject());
    }

    public function testHasAvailableSlotsWhenNoLimit(): void
    {
        $this->subject->setParticipantLimit(0);
        self::assertTrue($this->subject->hasAvailableSlots());
    }

    public function testHasAvailableSlotsWhenUnderLimit(): void
    {
        $this->subject->setParticipantLimit(10);
        self::assertTrue($this->subject->hasAvailableSlots());
    }

    public function testHasNoAvailableSlotsWhenFull(): void
    {
        $this->subject->setParticipantLimit(1);

        $registration = new EventRegistration();
        $registration->setStatus(EventRegistration::STATUS_REGISTERED);
        $this->subject->addRegistration($registration);

        self::assertFalse($this->subject->hasAvailableSlots());
    }

    public function testIsRegistrationOpenWhenDisabled(): void
    {
        $this->subject->setRegistrationEnabled(false);
        self::assertFalse($this->subject->isRegistrationOpen());
    }

    public function testIsRegistrationOpenWhenEnabled(): void
    {
        $this->subject->setRegistrationEnabled(true);
        self::assertTrue($this->subject->isRegistrationOpen());
    }

    public function testIsRegistrationClosedAfterDeadline(): void
    {
        $this->subject->setRegistrationEnabled(true);
        $pastDeadline = new \DateTimeImmutable('-1 day');
        $this->subject->setRegistrationDeadline($pastDeadline);
        self::assertFalse($this->subject->isRegistrationOpen());
    }

    public function testIsRegistrationOpenBeforeDeadline(): void
    {
        $this->subject->setRegistrationEnabled(true);
        $futureDeadline = new \DateTimeImmutable('+1 day');
        $this->subject->setRegistrationDeadline($futureDeadline);
        self::assertTrue($this->subject->isRegistrationOpen());
    }

    public function testGetConfirmedRegistrationsCount(): void
    {
        $reg1 = new EventRegistration();
        $reg1->setStatus(EventRegistration::STATUS_REGISTERED);
        $reg2 = new EventRegistration();
        $reg2->setStatus(EventRegistration::STATUS_WAITLISTED);
        $reg3 = new EventRegistration();
        $reg3->setStatus(EventRegistration::STATUS_CANCELLED);

        $this->subject->addRegistration($reg1);
        $this->subject->addRegistration($reg2);
        $this->subject->addRegistration($reg3);

        self::assertSame(1, $this->subject->getConfirmedRegistrationsCount());
    }
}
