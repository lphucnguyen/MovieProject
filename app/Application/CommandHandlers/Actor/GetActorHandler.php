<?php

namespace App\Application\CommandHandlers\Actor;

use App\Application\Commands\Actor\GetActorCommand;
use App\Application\DTOs\Actor\GetActorWithFilmsDTO;
use App\Domain\Repositories\IActorRepository;

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
