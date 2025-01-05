<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\DeleteUserCommand;
use App\Domain\Repositories\IUserRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class DeleteUserHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(DeleteUserCommand $command)
    {
        $user = $this->repository->get($command->uuid);
        $user->delete();
    }
}
