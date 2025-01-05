<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\CreateUserCommand;
use App\Domain\Repositories\IUserRepository;

class CreateUserHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(CreateUserCommand $command)
    {
        $data = $command->data;
        $data->avatar = $data->avatar->store('actor_avatars');
        $data->password = bcrypt($data->password);

        $this->repository->create($data->toArray());
    }
}
