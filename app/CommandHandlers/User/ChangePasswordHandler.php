<?php

namespace App\CommandHandlers\User;

use App\Commands\User\ChangePasswordCommand;
use App\Repositories\Contracts\IUserRepository;

class ChangePasswordHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(ChangePasswordCommand $command)
    {
        $this->repository->update([
            'password' => bcrypt($command->password)
        ], $command->uuid);
    }
}
