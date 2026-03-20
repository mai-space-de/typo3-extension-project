<?php

declare(strict_types=1);

namespace Maispace\MaiProject\Domain\Model;

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Event extends AbstractEntity
{
    protected string $title = '';
    protected ?\DateTimeImmutable $eventDate = null;
    protected ?\DateTimeImmutable $eventEndDate = null;
    protected string $location = '';
    protected string $description = '';
    protected ?Project $project = null;
    protected int $participantLimit = 0;
    protected bool $registrationEnabled = false;
    protected ?\DateTimeImmutable $registrationDeadline = null;

    /**
     * @var ObjectStorage<EventRegistration>
     */
    #[Lazy]
    protected ObjectStorage $registrations;

    public function __construct()
    {
        $this->registrations = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getEventDate(): ?\DateTimeImmutable
    {
        return $this->eventDate;
    }

    public function setEventDate(?\DateTimeImmutable $eventDate): void
    {
        $this->eventDate = $eventDate;
    }

    public function getEventEndDate(): ?\DateTimeImmutable
    {
        return $this->eventEndDate;
    }

    public function setEventEndDate(?\DateTimeImmutable $eventEndDate): void
    {
        $this->eventEndDate = $eventEndDate;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): void
    {
        $this->project = $project;
    }

    public function getParticipantLimit(): int
    {
        return $this->participantLimit;
    }

    public function setParticipantLimit(int $participantLimit): void
    {
        $this->participantLimit = $participantLimit;
    }

    public function isRegistrationEnabled(): bool
    {
        return $this->registrationEnabled;
    }

    public function setRegistrationEnabled(bool $registrationEnabled): void
    {
        $this->registrationEnabled = $registrationEnabled;
    }

    public function getRegistrationDeadline(): ?\DateTimeImmutable
    {
        return $this->registrationDeadline;
    }

    public function setRegistrationDeadline(?\DateTimeImmutable $registrationDeadline): void
    {
        $this->registrationDeadline = $registrationDeadline;
    }

    public function getRegistrations(): ObjectStorage
    {
        return $this->registrations;
    }

    public function setRegistrations(ObjectStorage $registrations): void
    {
        $this->registrations = $registrations;
    }

    public function addRegistration(EventRegistration $registration): void
    {
        $this->registrations->attach($registration);
    }

    public function removeRegistration(EventRegistration $registration): void
    {
        $this->registrations->detach($registration);
    }

    public function getConfirmedRegistrationsCount(): int
    {
        $count = 0;
        foreach ($this->registrations as $registration) {
            if ($registration->getStatus() === EventRegistration::STATUS_REGISTERED) {
                $count++;
            }
        }
        return $count;
    }

    public function hasAvailableSlots(): bool
    {
        if ($this->participantLimit <= 0) {
            return true;
        }
        return $this->getConfirmedRegistrationsCount() < $this->participantLimit;
    }

    public function isRegistrationOpen(): bool
    {
        if (!$this->registrationEnabled) {
            return false;
        }
        if ($this->registrationDeadline !== null && $this->registrationDeadline < new \DateTimeImmutable()) {
            return false;
        }
        return true;
    }
}
