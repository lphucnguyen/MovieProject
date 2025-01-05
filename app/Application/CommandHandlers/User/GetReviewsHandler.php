<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\GetReviewsCommand;
use App\Domain\Repositories\IUserRepository;

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
