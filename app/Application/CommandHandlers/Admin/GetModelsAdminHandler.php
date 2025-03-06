<?php

namespace App\Application\CommandHandlers\Admin;

use App\Application\Commands\Admin\GetModelsAdminCommand;
use App\Domain\Repositories\IAdminRepository;

class GetModelsAdminHandler
{
    public function __construct(
        private IAdminRepository $adminRepository
    ) {
    }

    public function handle(GetModelsAdminCommand $command)
    {
        $permissions = $this->adminRepository->get($command->adminId)->allPermissions();
        return $permissions->pluck('name');
    }
}
