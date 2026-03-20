<?php

declare(strict_types=1);

namespace Maispace\MaiProject\Controller;

use Maispace\MaiProject\Domain\Model\Event;
use Maispace\MaiProject\Domain\Repository\EventRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class EventController extends ActionController
{
    public function __construct(
        private readonly EventRepository $eventRepository
    ) {}

    public function listAction(): ResponseInterface
    {
        $events = $this->eventRepository->findUpcoming();
        $this->view->assign('events', $events);
        return $this->htmlResponse();
    }

    public function showAction(Event $event): ResponseInterface
    {
        $this->view->assign('event', $event);
        return $this->htmlResponse();
    }
}
