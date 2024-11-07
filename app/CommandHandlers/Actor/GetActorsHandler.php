<?php

namespace App\CommandHandlers\Actor;

use App\Commands\Actor\GetActorsCommand;
use App\Repositories\Contracts\IActorRepository;

class GetActorsHandler
{
    public function __construct(
        private IActorRepository $repository
    ) {
    }

    public function handle(GetActorsCommand $command)
    {
        return $this->repository->getActorsByQueryParams([
            'searchKey' => $command->searchKey,
            'film' => $command->film
        ]);
    }
}
