<?php

namespace App\Application\QueryFilters\Film;

use Closure;

class FilterByFavorite
{
    public function __construct(
        public array $queryParams
    ) {
    }

    public function handle($films, Closure $next)
    {
        $queryParams = $this->queryParams;

        $films =  $films->where(function ($query) use ($queryParams) {
            $query->when($queryParams['searchKeyFavorite'], function ($q) use ($queryParams) {
                return $q->whereHas('favorites', function ($q2) use ($queryParams) {
                    return $q2->whereIn('user_id', (array)$queryParams['searchKeyFavorite']);
                });
            });
        });

        return $next($films);
    }
}
