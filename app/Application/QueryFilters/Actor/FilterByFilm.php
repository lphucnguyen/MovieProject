<?php

namespace App\Application\QueryFilters\Actor;

use Closure;

class FilterByFilm
{
    public function __construct(
        public array $queryParams
    ) {
    }

    public function handle($actors, Closure $next)
    {
        $queryParams = $this->queryParams;

        $actors =  $actors->where(function ($query) use ($queryParams) {
            $query->when($queryParams['film'], function ($q) use ($queryParams) {
                return $q->whereHas('films', function ($q2) use ($queryParams) {
                    $q2->whereIn('film_id', (array)$queryParams['film']);
                });
            });
        });

        return $next($actors);
    }
}
