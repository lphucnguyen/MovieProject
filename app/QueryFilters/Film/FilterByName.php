<?php

namespace App\QueryFilters\Film;

use Closure;

class FilterByName
{
    public function __construct(
        public array $queryParams
    ) {
    }

    public function handle($films, Closure $next)
    {
        $queryParams = $this->queryParams;

        $films =  $films->where(function ($query) use ($queryParams) {
            $query->when($queryParams['searchKey'], function ($q) use ($queryParams) {
                return $q->where('name', 'like', '%' . $queryParams['searchKey'] . '%')
                    ->orWhere('year', 'like', '%' . $queryParams['searchKey'] . '%');
            });
        });

        return $next($films);
    }
}
