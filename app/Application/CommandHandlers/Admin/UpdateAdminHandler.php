<?php

namespace App\Application\CommandHandlers\Admin;

use App\Application\Commands\Admin\UpdateAdminCommand;
use App\Domain\Repositories\IAdminRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateAdminHandler
{
    public function __construct(
        private IAdminRepository $repository
    ) {
    }

    public function handle(UpdateAdminCommand $command)
    {
        DB::beginTransaction();

        $admin = $this->repository->get($command->uuid);
        $attributes = $command->data;

        if ($attributes->avatar) {
            $attributes->avatar = $attributes->avatar->store('admin_avatars');
        } else {
            unset($attributes->avatar);
        }

        if ($attributes->password) {
            $attributes->password = bcrypt($attributes->password);
        } else {
            unset($attributes->password);
        }

        $attributes = $attributes->toArray();

        $admin->update($attributes);
        $admin->syncPermissions($attributes['permissions']);

        DB::commit();
    }
}
