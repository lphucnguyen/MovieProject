<?php

namespace App\CommandHandlers\Actor;

use App\Commands\Actor\GetActorBySearchKeyCommand;
use App\DTOs\Actor\GetActorWithFilmsDTO;
use App\Repositories\Contracts\IActorRepository;

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
