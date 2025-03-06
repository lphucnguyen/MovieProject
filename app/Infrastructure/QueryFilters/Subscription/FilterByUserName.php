<?php

namespace App\Infrastructure\QueryFilters\Subscription;

use Closure;

class FilterByUserName
{
    public function __construct(
        public array $queryParams
    ) {
    }

    public function handle($subscriptions, Closure $next)
    {
        $queryParams = $this->queryParams;

        $subscriptions =  $subscriptions->orWhere(function ($query) use ($queryParams) {
            $query->when($queryParams['searchKey'], function ($q) use ($queryParams) {
                return $q->whereHas('user', function ($q2) use ($queryParams) {
                    return $q2->where('username', 'like', '%' . $queryParams['searchKey'] . '%');
                });
            });
        });

        return $next($subscriptions);
    }
}
