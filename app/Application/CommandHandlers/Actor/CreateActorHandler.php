<?php

namespace App\Application\CommandHandlers\Actor;

use App\Application\Commands\Actor\CreateActorCommand;
use App\Domain\Repositories\IActorRepository;
use Illuminate\Support\Facades\Storage;

class CreateActorHandler
{
    public function __construct(
        private IActorRepository $repository
    ) {
    }

    public function handle(CreateActorCommand $command)
    {
        $data = $command->data;
        $data->avatar = $data->avatar->store('actor_avatars');
        $data->background_cover = $data->background_cover->store('actor_background_covers');

        $this->repository->create($data->toArray());
    }
}
