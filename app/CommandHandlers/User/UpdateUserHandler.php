<?php

namespace App\CommandHandlers\User;

use App\Commands\User\UpdateUserCommand;
use App\Repositories\Contracts\IUserRepository;

class UpdateUserHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(UpdateUserCommand $command)
    {
        $user = $this->repository->get($command->uuid);

        $data = $command->data;
        $data->avatar = $data->avatar->store('actor_avatars');
        $data->password = bcrypt($data->password);

        $user->update($data->toArray());
    }
}
