<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\GetFavoritesCommand;
use App\Domain\Repositories\IUserRepository;

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
