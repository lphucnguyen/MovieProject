<?php

namespace App\Application\Commands\Subscription;

class GetSubscriptionsCommand
{
    public function __construct(
        public string|null $searchKey = null
    ) {
    }
}
