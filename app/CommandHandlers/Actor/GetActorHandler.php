<?php

namespace App\CommandHandlers\Actor;

use App\Commands\Actor\GetActorCommand;
use App\DTOs\Actor\GetActorWithFilmsDTO;
use App\Repositories\Contracts\IActorRepository;

class GetActorHandler
{
    public function __construct(
        private IActorRepository $repository
    ) {
    }

    public function handle(GetActorCommand $command)
    {
        $uuid = $command->uuid;
        $actor = $this->repository->get($uuid);
        $films = $this->repository->getFilms($uuid);

        $actorWithFilmsDTO = GetActorWithFilmsDTO::create([
            'actor' => $actor,
            'films' => $films
        ]);

        return $actorWithFilmsDTO;
    }
}
