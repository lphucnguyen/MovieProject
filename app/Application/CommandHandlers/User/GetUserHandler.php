<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\GetUserCommand;
use App\Domain\Repositories\IUserRepository;

class GetUserHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(GetUserCommand $command)
    {
        return $this->repository->get($command->uuid);
    }
}
