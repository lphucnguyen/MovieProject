<?php

namespace App\QueryFilters\Film;

use Closure;

class FilterByActor
{
    public function __construct(
        public array $queryParams
    ) {
    }

    public function handle($films, Closure $next)
    {
        $queryParams = $this->queryParams;

        $films =  $films->where(function ($query) use ($queryParams) {
            $query->when($queryParams['searchKeyActor'], function ($q) use ($queryParams) {
                return $q->whereHas('actors', function ($q2) use ($queryParams) {
                    return $q2->whereIn('actor_id', (array)$queryParams['searchKeyActor'])
                        ->orWhereIn('name', (array)$queryParams['searchKeyActor']);
                });
            });
        });

        return $next($films);
    }
}
