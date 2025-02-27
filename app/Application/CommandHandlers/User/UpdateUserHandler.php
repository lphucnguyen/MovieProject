<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\UpdateUserCommand;
use App\Domain\Repositories\IUserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateUserHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(UpdateUserCommand $command)
    {
        try {
            DB::beginTransaction();
            $user = $this->repository->get($command->uuid);

            $data = $command->data;

            if ($data->avatar) {
                $data->avatar = $data->avatar->store('client_avatars');
            } else {
                unset($data->avatar);
            }

            if ($data->password) {
                $data->password = bcrypt($data->password);
            } else {
                unset($data->password);
            }

            $user->update($data->toArray());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());
            throw $e;
        }
    }
}
