<?php

namespace App\Repositories\Eloquents;

use App\Rating;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IRatingRepository;
use Illuminate\Pipeline\Pipeline;

class RatingRepository extends BaseRepository implements IRatingRepository
{
    public function __construct(Rating $model)
    {
        parent::__construct($model);
    }

    public function getRatingsByQueryParams(array $queryParams)
    {
        $query = $this->makeQuery();

        return app(Pipeline::class)
            ->send($query)
            ->through([
                new \App\QueryFilters\Rating\FilterByUser($queryParams),
                new \App\QueryFilters\Rating\FilterByFilm($queryParams),
                new \App\QueryFilters\Rating\FilterByRating($queryParams),
            ])
            ->thenReturn()
            ->with('user')
            ->with('film')
            ->latest()
            ->paginate(config('app.perPage'));
    }
}
