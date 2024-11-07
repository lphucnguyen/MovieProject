<?php

namespace App\CommandHandlers\User;

use App\Commands\User\DeleteUserCommand;
use App\Repositories\Contracts\IUserRepository;
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
