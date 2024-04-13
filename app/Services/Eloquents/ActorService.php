<?php

namespace App\Services\Eloquents;

use App\DTOs\Actor\GetActorDTO;
use App\Repositories\Contracts\IActorRepository;
use App\Services\BaseService;
use App\Services\Contracts\IActorService;

class ActorService extends BaseService implements IActorService
{
    public function __construct(
        private IActorRepository $repository
    ) {
        parent::__construct($repository);
    }

    public function getActorWithFilms($uuid)
    {
        $actorWithFilms = $this->repository->getActorWithFilms($uuid);
        $actorWithFilmsDTO = GetActorDTO::create([
            'actor' => $actorWithFilms['actor'],
            'films' => $actorWithFilms['films']
        ]);

        return $actorWithFilmsDTO;
    }
}
