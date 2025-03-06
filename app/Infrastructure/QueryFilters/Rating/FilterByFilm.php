<?php

namespace App\Infrastructure\QueryFilters\Rating;

use Closure;

class FilterByFilm
{
    public function __construct(
        public array $queryParams
    ) {
    }

    public function handle($ratings, Closure $next)
    {
        $queryParams = $this->queryParams;

        $ratings =  $ratings->orWhere(function ($query) use ($queryParams) {
            $query->when($queryParams['searchKey'], function ($q) use ($queryParams) {
                return $q->whereHas('film', function ($q2) use ($queryParams) {
                    $q2->where('name', 'LIKE', "%" . $queryParams['searchKey'] . "%");
                });
            });

            $query->when($queryParams['film'], function ($q) use ($queryParams) {
                return $q->where('film_id', $queryParams['film']);
            });
        });

        return $next($ratings);
    }
}
