<?php

declare(strict_types=1);

namespace Maispace\Project\Service;

use Maispace\Project\Domain\Model\Event;
use Maispace\Project\Domain\Model\EventRegistration;
use Maispace\Project\Domain\Repository\EventRegistrationRepository;
use Maispace\Project\Event\EventCancelledEvent;
use Maispace\Project\Event\EventRegisteredEvent;
use Psr\EventDispatcher\EventDispatcherInterface;
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;

class EventRegistrationService
{
    public function __construct(
        private readonly EventRegistrationRepository $eventRegistrationRepository,
        private readonly PersistenceManagerInterface $persistenceManager,
        private readonly EventDispatcherInterface $eventDispatcher
    ) {}

    /**
     * Registers a FE user for an event.
     * If the event is full, the user is added to the waitlist.
     *
     * @throws \RuntimeException if registration is not open or user is already registered
     */
    public function register(Event $event, FrontendUser $feUser, string $notes = ''): EventRegistration
    {
        if (!$event->isRegistrationOpen()) {
            throw new \RuntimeException('Registration for this event is not open.', 1700000001);
        }

        $existing = $this->eventRegistrationRepository->findByEventAndUser($event, $feUser);
        if ($existing !== null && $existing->getStatus() !== EventRegistration::STATUS_CANCELLED) {
            throw new \RuntimeException('User is already registered for this event.', 1700000002);
        }

        $registration = new EventRegistration();
        $registration->setEvent($event);
        $registration->setFeUser($feUser);
        $registration->setNotes($notes);

        if ($event->hasAvailableSlots()) {
            $registration->setStatus(EventRegistration::STATUS_REGISTERED);
        } else {
            $registration->setStatus(EventRegistration::STATUS_WAITLISTED);
        }

        $this->eventRegistrationRepository->add($registration);
        $this->persistenceManager->persistAll();

        $this->eventDispatcher->dispatch(new EventRegisteredEvent($registration));

        return $registration;
    }

    /**
     * Cancels a user's registration for an event.
     * If there are waitlisted users, the first one is automatically promoted.
     *
     * @throws \RuntimeException if registration not found or already cancelled
     */
    public function cancel(Event $event, FrontendUser $feUser): EventRegistration
    {
        $registration = $this->eventRegistrationRepository->findByEventAndUser($event, $feUser);

        if ($registration === null) {
            throw new \RuntimeException('No registration found for this user and event.', 1700000003);
        }

        if ($registration->getStatus() === EventRegistration::STATUS_CANCELLED) {
            throw new \RuntimeException('Registration is already cancelled.', 1700000004);
        }

        $wasRegistered = $registration->getStatus() === EventRegistration::STATUS_REGISTERED;
        $registration->setStatus(EventRegistration::STATUS_CANCELLED);
        $this->eventRegistrationRepository->update($registration);
        $this->persistenceManager->persistAll();

        $this->eventDispatcher->dispatch(new EventCancelledEvent($registration));

        if ($wasRegistered) {
            $this->promoteFromWaitlist($event);
        }

        return $registration;
    }

    /**
     * Promotes the first waitlisted user to registered status.
     */
    private function promoteFromWaitlist(Event $event): void
    {
        $waitlisted = $this->eventRegistrationRepository->findWaitlistedByEvent($event);
        $first = $waitlisted->getFirst();

        if ($first instanceof EventRegistration) {
            $first->setStatus(EventRegistration::STATUS_REGISTERED);
            $this->eventRegistrationRepository->update($first);
            $this->persistenceManager->persistAll();
            $this->eventDispatcher->dispatch(new EventRegisteredEvent($first));
        }
    }

    /**
     * Returns the current waitlist for an event.
     */
    public function getWaitlist(Event $event): \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
    {
        return $this->eventRegistrationRepository->findWaitlistedByEvent($event);
    }
}
