<?php

namespace App\Application\CommandHandlers\Admin;

use App\Application\Commands\Admin\UpdatePermissionsAdminCommand;
use App\Domain\Repositories\IAdminRepository;
use Illuminate\Support\Facades\DB;

class UpdatePermissionsAdminHandler
{
    public function __construct(
        private IAdminRepository $repository
    ) {
    }

    public function handle(UpdatePermissionsAdminCommand $command)
    {
        try {
            DB::beginTransaction();

            $admin = $this->repository->getWithLock($command->uuid);
            $data = $command->data;

            $admin->syncPermissions($data->permissions);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
