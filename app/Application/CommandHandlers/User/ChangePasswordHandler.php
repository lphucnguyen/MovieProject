<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\ChangePasswordCommand;
use App\Domain\Repositories\IUserRepository;

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
