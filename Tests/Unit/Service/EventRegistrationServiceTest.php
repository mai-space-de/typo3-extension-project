<?php

declare(strict_types=1);

namespace Maispace\Project\Tests\Unit\Service;

use Maispace\Project\Domain\Model\Event;
use Maispace\Project\Domain\Model\EventRegistration;
use Maispace\Project\Domain\Repository\EventRegistrationRepository;
use Maispace\Project\Event\EventCancelledEvent;
use Maispace\Project\Event\EventRegisteredEvent;
use Maispace\Project\Service\EventRegistrationService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\EventDispatcher\EventDispatcherInterface;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;

class EventRegistrationServiceTest extends TestCase
{
    private EventRegistrationService $subject;
    private EventRegistrationRepository&MockObject $registrationRepository;
    private PersistenceManagerInterface&MockObject $persistenceManager;
    private EventDispatcherInterface&MockObject $eventDispatcher;

    protected function setUp(): void
    {
        $this->registrationRepository = $this->createMock(EventRegistrationRepository::class);
        $this->persistenceManager = $this->createMock(PersistenceManagerInterface::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);

        $this->subject = new EventRegistrationService(
            $this->registrationRepository,
            $this->persistenceManager,
            $this->eventDispatcher
        );
    }

    public function testRegisterThrowsExceptionWhenRegistrationNotOpen(): void
    {
        $event = new Event();
        $event->setRegistrationEnabled(false);
        $feUser = new FrontendUser();

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionCode(1700000001);

        $this->subject->register($event, $feUser);
    }

    public function testRegisterThrowsExceptionWhenAlreadyRegistered(): void
    {
        $event = new Event();
        $event->setRegistrationEnabled(true);
        $feUser = new FrontendUser();

        $existingRegistration = new EventRegistration();
        $existingRegistration->setStatus(EventRegistration::STATUS_REGISTERED);

        $this->registrationRepository
            ->expects(self::once())
            ->method('findByEventAndUser')
            ->willReturn($existingRegistration);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionCode(1700000002);

        $this->subject->register($event, $feUser);
    }

    public function testRegisterCreatesRegistrationWithRegisteredStatus(): void
    {
        $event = new Event();
        $event->setRegistrationEnabled(true);
        $feUser = new FrontendUser();

        $this->registrationRepository
            ->expects(self::once())
            ->method('findByEventAndUser')
            ->willReturn(null);

        $this->registrationRepository
            ->expects(self::once())
            ->method('add');

        $this->persistenceManager
            ->expects(self::once())
            ->method('persistAll');

        $this->eventDispatcher
            ->expects(self::once())
            ->method('dispatch')
            ->with(self::isInstanceOf(EventRegisteredEvent::class));

        $registration = $this->subject->register($event, $feUser);

        self::assertSame(EventRegistration::STATUS_REGISTERED, $registration->getStatus());
    }

    public function testRegisterCreatesWaitlistRegistrationWhenFull(): void
    {
        $event = new Event();
        $event->setRegistrationEnabled(true);
        $event->setParticipantLimit(1);

        $existingReg = new EventRegistration();
        $existingReg->setStatus(EventRegistration::STATUS_REGISTERED);
        $event->addRegistration($existingReg);

        $feUser = new FrontendUser();

        $this->registrationRepository
            ->expects(self::once())
            ->method('findByEventAndUser')
            ->willReturn(null);

        $this->registrationRepository->expects(self::once())->method('add');
        $this->persistenceManager->expects(self::once())->method('persistAll');
        $this->eventDispatcher->expects(self::once())->method('dispatch');

        $registration = $this->subject->register($event, $feUser);

        self::assertSame(EventRegistration::STATUS_WAITLISTED, $registration->getStatus());
    }

    public function testCancelThrowsExceptionWhenNoRegistrationFound(): void
    {
        $event = new Event();
        $feUser = new FrontendUser();

        $this->registrationRepository
            ->expects(self::once())
            ->method('findByEventAndUser')
            ->willReturn(null);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionCode(1700000003);

        $this->subject->cancel($event, $feUser);
    }

    public function testCancelThrowsExceptionWhenAlreadyCancelled(): void
    {
        $event = new Event();
        $feUser = new FrontendUser();

        $existingRegistration = new EventRegistration();
        $existingRegistration->setStatus(EventRegistration::STATUS_CANCELLED);

        $this->registrationRepository
            ->expects(self::once())
            ->method('findByEventAndUser')
            ->willReturn($existingRegistration);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionCode(1700000004);

        $this->subject->cancel($event, $feUser);
    }

    public function testCancelSetsStatusToCancelledAndDispatchesEvent(): void
    {
        $event = new Event();
        $feUser = new FrontendUser();

        $registration = new EventRegistration();
        $registration->setStatus(EventRegistration::STATUS_REGISTERED);

        $this->registrationRepository
            ->expects(self::once())
            ->method('findByEventAndUser')
            ->willReturn($registration);

        $this->registrationRepository->expects(self::once())->method('update');
        $this->persistenceManager->expects(self::atLeastOnce())->method('persistAll');

        $this->eventDispatcher
            ->expects(self::once())
            ->method('dispatch')
            ->with(self::isInstanceOf(EventCancelledEvent::class));

        // No waitlisted users
        $waitlistResult = $this->createMock(\TYPO3\CMS\Extbase\Persistence\QueryResultInterface::class);
        $waitlistResult->method('getFirst')->willReturn(null);
        $this->registrationRepository->method('findWaitlistedByEvent')->willReturn($waitlistResult);

        $cancelled = $this->subject->cancel($event, $feUser);

        self::assertSame(EventRegistration::STATUS_CANCELLED, $cancelled->getStatus());
    }
}
