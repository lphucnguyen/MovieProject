<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Category;
use App\Domain\Models\Film;
use App\Domain\Repositories\ICategoryRepository;
use App\Shared\Infrastructure\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    public function __construct(
        Category $model
    ) {
        parent::__construct($model);
    }

    public function getCategoriesByQueryParams(array $queryParams)
    {
        $query = $this->makeQuery();

        return $query->where(function ($query) use ($queryParams) {
            $query->when($queryParams['searchKey'], function ($q) use ($queryParams) {
                return $q->where('name', 'like', '%' . $queryParams['searchKey'] . '%');
            });
        })->latest()->paginate(config('app.perPage'));
    }

    public function getLatestCategoriesWithFilms(int $limitCategory, int $limitFilm)
    {
        $categories = $this->model->select('id')->limit($limitCategory)->get();

        foreach ($categories as $category) {
            $movies = DB::select("
                SELECT DISTINCT f.*
                FROM films f
                INNER JOIN film_category fc ON f.id = fc.film_id
                INNER JOIN categories c ON fc.category_id = c.id
                WHERE c.id = ?
                LIMIT ?
            ", [$category->id, $limitFilm]);

            $movies = collect($movies)->map(function ($movie) {
                return new Film((array) $movie);
            });

            $category->setRelation('films', $movies);
        }

        return $categories;
    }
}
