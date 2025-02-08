<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\UpdateProfileCommand;
use App\Domain\Repositories\IUserRepository;

class UpdateProfileHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(UpdateProfileCommand $command)
    {
        $data = $command->data;
        $this->repository->update($command->uuid, $data->toArray());
    }
}
