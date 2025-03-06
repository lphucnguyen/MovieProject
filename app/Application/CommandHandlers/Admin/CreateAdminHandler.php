<?php

namespace App\Application\CommandHandlers\Admin;

use App\Application\Commands\Admin\CreateAdminCommand;
use App\Domain\Repositories\IAdminRepository;
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
        try {
            DB::beginTransaction();
            $data = $command->data;

            $parts = explode("/", $data->avatar);
            $file = implode('/', array_slice($parts, -2));
            $data->avatar = $file;

            $admin = $this->repository->create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => bcrypt($data->password),
                'avatar' => $data->avatar
            ]);
            $admin->attachRole('admin');
            $admin->syncPermissions($data->permissions);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($data->avatar) {
                Storage::delete($data->avatar);
            }
            throw $e;
        }
    }
}
