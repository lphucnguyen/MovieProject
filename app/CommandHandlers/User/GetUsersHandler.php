<?php

namespace App\CommandHandlers\User;

use App\Commands\User\GetUsersCommand;
use App\Repositories\Contracts\IUserRepository;

class GetUsersHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(GetUsersCommand $command)
    {
        $query = $this->repository->makeQuery();
        return $query->when($command->searchKey, function ($q) use ($command) {
            return $q->where('username', 'like', '%' . $command->searchKey . '%')
                ->orWhere('first_name', 'like', '%' . $command->searchKey . '%')
                ->orWhere('last_name', 'like', '%' . $command->searchKey . '%')
                ->orWhere('email', 'like', '%' . $command->searchKey . '%');
        })->latest()->paginate($command->perPage);
    }
}