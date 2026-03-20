<?php

declare(strict_types=1);

namespace Maispace\MaiProject\Controller;

use Maispace\MaiProject\Domain\Model\Event;
use Maispace\MaiProject\Domain\Repository\EventRegistrationRepository;
use Maispace\MaiProject\Service\EventRegistrationService;
use Psr\Http\Message\ResponseInterface;
use Maispace\MaiProject\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class EventRegistrationController extends ActionController
{
    public function __construct(
        private readonly EventRegistrationService $eventRegistrationService,
        private readonly EventRegistrationRepository $eventRegistrationRepository,
        private readonly FrontendUserRepository $frontendUserRepository
    ) {}

    public function formAction(Event $event): ResponseInterface
    {
        $this->view->assign('event', $event);
        return $this->htmlResponse();
    }

    public function registerAction(Event $event, string $notes = ''): ResponseInterface
    {
        $feUserData = $this->request->getAttribute('frontend.user')?->user ?? null;
        if ($feUserData === null || empty($feUserData['uid'])) {
            $this->addFlashMessage('You must be logged in to register.', '', \TYPO3\CMS\Core\Type\ContextualFeedbackSeverity::ERROR);
            return $this->redirect('form', null, null, ['event' => $event]);
        }

        try {
            $frontendUserObject = $this->frontendUserRepository->findByUid((int)$feUserData['uid']);
            if ($frontendUserObject === null) {
                throw new \RuntimeException('Could not load frontend user.', 1700000005);
            }
            $this->eventRegistrationService->register($event, $frontendUserObject, $notes);
            $this->addFlashMessage('Registration successful.');
        } catch (\RuntimeException $e) {
            $this->addFlashMessage($e->getMessage(), '', \TYPO3\CMS\Core\Type\ContextualFeedbackSeverity::ERROR);
        }

        return $this->redirect('show', 'Event', null, ['event' => $event]);
    }

    public function cancelAction(Event $event): ResponseInterface
    {
        $feUserData = $this->request->getAttribute('frontend.user')?->user ?? null;
        if ($feUserData === null || empty($feUserData['uid'])) {
            $this->addFlashMessage('You must be logged in to cancel.', '', \TYPO3\CMS\Core\Type\ContextualFeedbackSeverity::ERROR);
            return $this->redirect('form', null, null, ['event' => $event]);
        }

        try {
            $frontendUserObject = $this->frontendUserRepository->findByUid((int)$feUserData['uid']);
            if ($frontendUserObject === null) {
                throw new \RuntimeException('Could not load frontend user.', 1700000005);
            }
            $this->eventRegistrationService->cancel($event, $frontendUserObject);
            $this->addFlashMessage('Registration cancelled successfully.');
        } catch (\RuntimeException $e) {
            $this->addFlashMessage($e->getMessage(), '', \TYPO3\CMS\Core\Type\ContextualFeedbackSeverity::ERROR);
        }

        return $this->redirect('show', 'Event', null, ['event' => $event]);
    }

    public function participantListAction(Event $event): ResponseInterface
    {
        $registrations = $this->eventRegistrationRepository->findByEvent($event);
        $this->view->assign('event', $event);
        $this->view->assign('registrations', $registrations);
        return $this->htmlResponse();
    }
}
