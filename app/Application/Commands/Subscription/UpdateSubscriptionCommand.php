<?php

namespace App\Application\Commands\Subscription;

class UpdateSubscriptionCommand
{
    public function __construct(
        public string $uuid,
        public string $activeUntil,
    ) {
    }
}
