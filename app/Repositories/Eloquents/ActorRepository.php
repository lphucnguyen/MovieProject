<?php

namespace App\Repositories\Eloquents;

use App\Actor;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IActorRepository;

class ActorRepository extends BaseRepository implements IActorRepository
{
    public function __construct(
        protected Actor $model
    ) {
        parent::__construct($model);
    }

    public function getActorWithFilms($uuid)
    {
        $actor = $this->model->findOrFail($uuid);

        return [
            'actor' => $actor,
            'films' => $actor->films()->latest()->paginate(10)
        ];
    }
}
