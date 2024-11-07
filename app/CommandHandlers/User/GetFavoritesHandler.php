<?php

namespace App\CommandHandlers\User;

use App\Commands\User\GetFavoritesCommand;
use App\Repositories\Contracts\IUserRepository;

class GetFavoritesHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(GetFavoritesCommand $command)
    {
        return $this->repository->getFavorites($command->uuid);
    }
}
