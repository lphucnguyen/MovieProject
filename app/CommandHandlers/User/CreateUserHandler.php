<?php

namespace App\CommandHandlers\User;

use App\Commands\User\CreateUserCommand;
use App\Repositories\Contracts\IUserRepository;
use Illuminate\Support\Facades\Storage;

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
