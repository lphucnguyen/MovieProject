<?php

namespace App\CommandHandlers\Actor;

use App\Commands\Actor\DeleteActorCommand;
use App\Repositories\Contracts\IActorRepository;

class DeleteActorHandler
{
    public function __construct(
        private IActorRepository $repository
    ) {
    }

    public function handle(DeleteActorCommand $command)
    {
        $actor = $this->repository->get($command->uuid);
        $actor->delete();
    }
}
