<?php

namespace App\Infrastructure\QueryFilters\Subscription;

use Closure;

class FilterBySlug
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
                return $q->orWhere('slug', $queryParams['searchKey']);
            });
        });

        return $next($subscriptions);
    }
}