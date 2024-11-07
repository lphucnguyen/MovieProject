<?php

namespace App\Repositories\Eloquents;

use App\Actor;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IActorRepository;
use Illuminate\Pipeline\Pipeline;

class ActorRepository extends BaseRepository implements IActorRepository
{
    public function __construct(
        protected Actor $model
    ) {
        parent::__construct($model);
    }

    public function getFilms($uuid)
    {
        $films = $this->get($uuid)
                        ->films()
                        ->latest()
                        ->paginate(config('app.perPage'));

        return $films;
    }

    public function getActorsByQueryParams(array $queryParams)
    {
        $query = $this->makeQuery();

        return app(Pipeline::class)
            ->send($query)
            ->through([
                new \App\QueryFilters\Actor\FilterByName($queryParams),
                new \App\QueryFilters\Actor\FilterByFilm($queryParams),
            ])
            ->thenReturn()
            ->latest()
            ->paginate(config('app.perPage'));
    }
}
