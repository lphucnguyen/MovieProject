<?php

namespace App\Application\CommandHandlers\Actor;

use App\Application\Commands\Actor\GetActorBySearchKeyCommand;
use App\Application\DTOs\Actor\GetActorWithFilmsDTO;
use App\Domain\Repositories\IActorRepository;

class GetActorBySearchKeyHandler
{
    public function __construct(
        private IActorRepository $repository
    ) {
    }

    public function handle(GetActorBySearchKeyCommand $command)
    {
        $searchKey = $command->searchKey;
        // $actor = $this->repository->get($uuid);

        // $actorWithFilmsDTO = GetActorWithFilmsDTO::create([
        //     'actor' => $actor,
        //     'films' => $films
        // ]);

        // return $actorWithFilmsDTO;
    }
}
