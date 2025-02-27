<?php

namespace App\Application\CommandHandlers\User;

use App\Application\Commands\User\UpdateProfileCommand;
use App\Domain\Repositories\IUserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateProfileHandler
{
    public function __construct(
        private IUserRepository $repository
    ) {
    }

    public function handle(UpdateProfileCommand $command)
    {
        try {
            DB::beginTransaction();
            $data = $command->data;

            if ($data->avatar) {
                $data->avatar = $data->avatar->store('client_avatars');
            } else {
                unset($data->avatar);
            }

            $this->repository->update($command->uuid, $data->toArray());
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());

            throw $e;
        }
    }
}
