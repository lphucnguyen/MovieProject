<?php

namespace App\QueryFilters\Actor;

use Closure;

class FilterByName
{
    public function __construct(
        public array $queryParams
    ) {
    }

    public function handle($actors, Closure $next)
    {
        $queryParams = $this->queryParams;

        $actors =  $actors->where(function ($query) use ($queryParams) {
            $query->when($queryParams['searchKey'], function ($q) use ($queryParams) {
                return $q->where('name', 'like', '%' . $queryParams['searchKey'] . '%');
            });
        });

        return $next($actors);
    }
}
