<?php

namespace App\Application\Commands\Subscription;

class GetSubscriptionCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
