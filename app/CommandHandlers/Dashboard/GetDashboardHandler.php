<?php

namespace App\CommandHandlers\Dashboard;

use App\Commands\Dashboard\GetDashboardCommand;
use App\DTOs\Dashboard\GetAnalysisReponse;
use App\Repositories\Contracts\IActorRepository;
use App\Repositories\Contracts\IAdminRepository;
use App\Repositories\Contracts\ICategoryRepository;
use App\Repositories\Contracts\IFilmRepository;
use App\Repositories\Contracts\IMessageRepository;
use App\Repositories\Contracts\IRatingRepository;
use App\Repositories\Contracts\IReviewRepository;
use App\Repositories\Contracts\IUserRepository;

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
