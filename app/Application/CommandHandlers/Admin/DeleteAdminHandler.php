<?php

namespace App\Application\CommandHandlers\Admin;

use App\Application\Commands\Admin\DeleteAdminCommand;
use App\Domain\Repositories\IAdminRepository;

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
