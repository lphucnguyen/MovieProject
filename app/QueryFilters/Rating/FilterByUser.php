<?php

namespace App\QueryFilters\Rating;

use Closure;

class FilterByUser
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
                return $q->whereHas('user', function ($q2) use ($queryParams) {
                    $q2->where('username', 'LIKE', "%" . $queryParams['searchKey'] . "%");
                });
            });

            $query->when($queryParams['client'], function ($q) use ($queryParams) {
                return $q->whereHas('user', function ($q2) use ($queryParams) {
                    return $q2->where('id', $queryParams['client']);
                });
            });
        });

        return $next($ratings);
    }
}
