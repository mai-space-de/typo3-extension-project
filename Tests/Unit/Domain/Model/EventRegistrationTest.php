<?php

declare(strict_types=1);

namespace Maispace\Project\Tests\Unit\Domain\Model;

use Maispace\Project\Domain\Model\Event;
use Maispace\Project\Domain\Model\EventRegistration;
use PHPUnit\Framework\TestCase;
use Maispace\Project\Domain\Model\FrontendUser;

class EventRegistrationTest extends TestCase
{
    private EventRegistration $subject;

    protected function setUp(): void
    {
        $this->subject = new EventRegistration();
    }

    public function testInitialStatusIsRegistered(): void
    {
        self::assertSame(EventRegistration::STATUS_REGISTERED, $this->subject->getStatus());
    }

    public function testSetStatus(): void
    {
        $this->subject->setStatus(EventRegistration::STATUS_WAITLISTED);
        self::assertSame(EventRegistration::STATUS_WAITLISTED, $this->subject->getStatus());
    }

    public function testSetFeUser(): void
    {
        $feUser = new FrontendUser();
        $this->subject->setFeUser($feUser);
        self::assertSame($feUser, $this->subject->getFeUser());
    }

    public function testSetEvent(): void
    {
        $event = new Event();
        $this->subject->setEvent($event);
        self::assertSame($event, $this->subject->getEvent());
    }

    public function testInitialReminderSentIsFalse(): void
    {
        self::assertFalse($this->subject->isReminderSent());
    }

    public function testSetReminderSent(): void
    {
        $this->subject->setReminderSent(true);
        self::assertTrue($this->subject->isReminderSent());
    }

    public function testInitialNotesIsEmpty(): void
    {
        self::assertSame('', $this->subject->getNotes());
    }

    public function testSetNotes(): void
    {
        $this->subject->setNotes('Test notes');
        self::assertSame('Test notes', $this->subject->getNotes());
    }
}
