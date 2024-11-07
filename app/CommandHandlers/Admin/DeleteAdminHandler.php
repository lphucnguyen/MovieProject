<?php

namespace App\CommandHandlers\Admin;

use App\Commands\Admin\DeleteAdminCommand;
use App\Repositories\Contracts\IAdminRepository;

class DeleteAdminHandler
{
    public function __construct(
        private IAdminRepository $repository
    ) {
    }

    public function handle(DeleteAdminCommand $command)
    {
        $admin = $this->repository->get($command->uuid);
        $admin->delete();
    }
}
