<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\GetRatingsCommand;
use App\Domain\Repositories\IUserRepository;

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
