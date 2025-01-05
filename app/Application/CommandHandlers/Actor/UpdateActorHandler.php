<?php

namespace App\Application\CommandHandlers\Actor;

use App\Application\Commands\Actor\UpdateActorCommand;
use App\Domain\Repositories\IActorRepository;
use Illuminate\Support\Facades\Storage;

class UpdateActorHandler
{
    public function __construct(
        private IActorRepository $repository
    ) {
    }

    public function handle(UpdateActorCommand $command)
    {
        $data = $command->data;

        if ($data->avatar) {
            $data->avatar = $data->avatar->store('actor_avatars');
        } else {
            unset($data->avatar);
        }

        if ($data->background_cover) {
            $data->background_cover = $data->background_cover->store('actor_background_covers');
        } else {
            unset($data->background_cover);
        }

        $this->repository->update($command->uuid, $data->toArray());
    }
}
