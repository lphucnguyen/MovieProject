<?php

namespace App\Application\CommandHandlers\Dashboard;

use App\Application\Commands\Dashboard\GetDashboardCommand;
use App\Application\DTOs\Dashboard\GetAnalysisReponse;
use App\Domain\Repositories\IActorRepository;
use App\Domain\Repositories\IAdminRepository;
use App\Domain\Repositories\ICategoryRepository;
use App\Domain\Repositories\IFilmRepository;
use App\Domain\Repositories\IMessageRepository;
use App\Domain\Repositories\IRatingRepository;
use App\Domain\Repositories\IReviewRepository;
use App\Domain\Repositories\IUserRepository;

class GetDashboardHandler
{
    public function __construct(
        private IRatingRepository $ratingRepository,
        private IUserRepository $userRepository,
        private IReviewRepository $reviewRepository,
        private IActorRepository $actorRepository,
        private IMessageRepository $messageRepository,
        private IAdminRepository $adminRepository,
        private ICategoryRepository $categoryRepository,
        private IFilmRepository $filmRepository,
    ) {
    }

    public function handle(GetDashboardCommand $command)
    {
        return new GetAnalysisReponse([
            'admins' => $this->adminRepository->count(),
            'clients' => $this->userRepository->count(),
            'films' => $this->filmRepository->count(),
            'categories' => $this->categoryRepository->count(),
            'ratings' => $this->ratingRepository->count(),
            'reviews' => $this->reviewRepository->count(),
            'actors' => $this->actorRepository->count(),
            'messages' => $this->messageRepository->count(),
        ]);
    }
}
