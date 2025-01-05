<?php

namespace App\Application\CommandHandlers\Actor;

use App\Application\Commands\Actor\DeleteActorCommand;
use App\Domain\Repositories\IActorRepository;

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
