<?php

namespace App\CommandHandlers\User;

use App\Commands\User\UpdateProfileCommand;
use App\Repositories\Contracts\IUserRepository;

class UpdateProfileHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(UpdateProfileCommand $command)
    {
        $data = $command->data;
        $this->repository->update($data->toArray(), $command->uuid);
    }
}
