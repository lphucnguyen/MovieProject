<?php

namespace App\Application\CommandHandlers\Admin;

use App\Application\Commands\Admin\GetAdminsCommand;
use App\Domain\Repositories\IAdminRepository;

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
