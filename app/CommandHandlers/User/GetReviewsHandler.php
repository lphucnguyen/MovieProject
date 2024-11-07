<?php

namespace App\CommandHandlers\User;

use App\Commands\User\GetReviewsCommand;
use App\Repositories\Contracts\IUserRepository;

class GetReviewsHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(GetReviewsCommand $command)
    {
        return $this->repository->getReviews($command->uuid);
    }
}
