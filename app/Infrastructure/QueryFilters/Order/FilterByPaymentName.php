<?php

namespace App\Infrastructure\QueryFilters\Order;

use Closure;

class FilterByPaymentName
{
    public function __construct(
        public array $queryParams
    ) {
    }

    public function handle($orders, Closure $next)
    {
        $queryParams = $this->queryParams;

        $orders =  $orders->where(function ($query) use ($queryParams) {
            $query->when($queryParams['searchKey'], function ($q) use ($queryParams) {
                return $q->orWhere('payment_name', $queryParams['searchKey']);
            });
        });

        return $next($orders);
    }
}
