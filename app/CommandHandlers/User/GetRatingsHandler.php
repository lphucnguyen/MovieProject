<?php

namespace App\CommandHandlers\User;

use App\Commands\User\GetRatingsCommand;
use App\Repositories\Contracts\IUserRepository;

class GetRatingsHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(GetRatingsCommand $command)
    {
        return $this->repository->getRatings($command->uuid);
    }
}
