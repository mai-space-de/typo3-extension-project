<?php

declare(strict_types=1);

namespace Maispace\MaiProject\Domain\Model;

use Maispace\MaiProject\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class EventRegistration extends AbstractEntity
{
    public const STATUS_REGISTERED = 'registered';
    public const STATUS_WAITLISTED = 'waitlisted';
    public const STATUS_CANCELLED = 'cancelled';

    protected ?FrontendUser $feUser = null;
    protected ?Event $event = null;
    protected string $status = self::STATUS_REGISTERED;
    protected bool $reminderSent = false;
    protected string $notes = '';

    public function getFeUser(): ?FrontendUser
    {
        return $this->feUser;
    }

    public function setFeUser(?FrontendUser $feUser): void
    {
        $this->feUser = $feUser;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): void
    {
        $this->event = $event;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function isReminderSent(): bool
    {
        return $this->reminderSent;
    }

    public function setReminderSent(bool $reminderSent): void
    {
        $this->reminderSent = $reminderSent;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }
}
