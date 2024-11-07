<?php

namespace App\CommandHandlers\Admin;

use App\Commands\Admin\CreateAdminCommand;
use App\Repositories\Contracts\IAdminRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateAdminHandler
{
    public function __construct(
        private IAdminRepository $repository
    ) {
    }

    public function handle(CreateAdminCommand $command)
    {
        DB::beginTransaction();

        $data = $command->data;
        if ($data->avatar) {
            $data->avatar = $data->avatar->store('admin_avatars');
        }

        $admin = $this->repository->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'avatar' => $data->avatar
        ]);
        $admin->attachRole('admin');
        $admin->syncPermissions($data->permissions);

        DB::commit();
    }
}
