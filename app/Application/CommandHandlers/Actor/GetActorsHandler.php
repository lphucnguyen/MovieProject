<?php

namespace App\Application\CommandHandlers\Actor;

use App\Application\Commands\Actor\GetActorsCommand;
use App\Domain\Repositories\IActorRepository;

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
            'searchKeyFilm' => $command->searchKeyFilm
        ]);
    }
}
