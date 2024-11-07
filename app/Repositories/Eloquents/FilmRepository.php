<?php

namespace App\Repositories\Eloquents;

use App\Film;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\IFilmRepository;
use Illuminate\Pipeline\Pipeline;

class FilmRepository extends BaseRepository implements IFilmRepository
{
    public function __construct(
        private Film $model
    ) {
        parent::__construct($model);
    }

    public function getFilmByCategoryName($categoryName)
    {
        return $this->model->where(function ($query) use ($categoryName) {
            $query->when($categoryName, function ($query) use ($categoryName) {
                return $query->whereHas('categories', function ($query2) use ($categoryName) {
                    return $query2->whereIn('name', (array)$categoryName);
                });
            });
        })->latest()->paginate(config('app.perPage'));
    }

    public function getReviews($uuid)
    {
        return $this->get($uuid)->reviews()->latest()->paginate(config('app.perPage'));
    }

    public function getFilmsByQueryParams(array $queryParams)
    {
        $query = $this->makeQuery();

        return app(Pipeline::class)
            ->send($query)
            ->through([
                new \App\QueryFilters\Film\FilterByName($queryParams),
                new \App\QueryFilters\Film\FilterByCategory($queryParams),
                new \App\QueryFilters\Film\FilterByActor($queryParams),
                new \App\QueryFilters\Film\FilterByFavorite($queryParams),
            ])
            ->thenReturn()
            ->with('categories')
            ->with('ratings')
            ->latest()
            ->paginate(config('app.perPage'));
    }
}
