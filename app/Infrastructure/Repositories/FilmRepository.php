<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Film;

use App\Domain\Repositories\IFilmRepository;
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
                new \App\Application\QueryFilters\Film\FilterByName($queryParams),
                new \App\Application\QueryFilters\Film\FilterByCategory($queryParams),
                new \App\Application\QueryFilters\Film\FilterByActor($queryParams),
                new \App\Application\QueryFilters\Film\FilterByFavorite($queryParams),
            ])
            ->thenReturn()
            ->with('categories')
            ->with('ratings')
            ->latest()
            ->paginate(config('app.perPage'));
    }
}
