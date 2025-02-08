<?php

namespace App\Infrastructure\QueryFilters\Film;

use Closure;

class FilterByCategory
{
    public function __construct(
        public array $queryParams
    ) {
    }

    public function handle($films, Closure $next)
    {
        $queryParams = $this->queryParams;

        $films =  $films->where(function ($query) use ($queryParams) {
            $query->when($queryParams['searchKeyCategory'], function ($q) use ($queryParams) {
                return $q->whereHas('categories', function ($q2) use ($queryParams) {
                    return $q2->whereIn('category_id', (array)$queryParams['searchKeyCategory'])
                        ->orWhereIn('name', (array)$queryParams['searchKeyCategory']);
                });
            });
        });

        return $next($films);
    }
}
