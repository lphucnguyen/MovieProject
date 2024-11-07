<?php

namespace App\CommandHandlers\Admin;

use App\Commands\Admin\GetAdminsCommand;
use App\Repositories\Contracts\IAdminRepository;

class GetAdminsHandler
{
    public function __construct(
        private IAdminRepository $repository
    ) {
    }

    public function handle(GetAdminsCommand $command)
    {
        $query = $this->repository->makeQuery();

        return $query->whereRoleIs('admin')->when($command->searchKey, function ($q) use ($command) {
            return $q->where('name', 'like', '%' . $command->searchKey . '%')
                ->orWhere('email', 'like', '%' . $command->searchKey . '%');
        })->latest()->paginate($command->perPage);
    }
}
