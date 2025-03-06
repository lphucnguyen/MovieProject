<?php

namespace App\Application\Commands\Subscription;

class DeleteSubscriptionCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
