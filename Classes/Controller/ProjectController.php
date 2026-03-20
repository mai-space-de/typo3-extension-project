<?php

declare(strict_types=1);

namespace Maispace\MaiProject\Controller;

use Maispace\MaiProject\Domain\Model\Project;
use Maispace\MaiProject\Domain\Repository\ProjectRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ProjectController extends ActionController
{
    public function __construct(
        private readonly ProjectRepository $projectRepository
    ) {}

    public function listAction(): ResponseInterface
    {
        $projects = $this->projectRepository->findAll();
        $this->view->assign('projects', $projects);
        return $this->htmlResponse();
    }

    public function showAction(Project $project): ResponseInterface
    {
        $this->view->assign('project', $project);
        return $this->htmlResponse();
    }
}
