<?php

namespace App\Application\Commands\Subscription;

class GetSubscriptionByUserIdCommand
{
    public function __construct(
        public string $userId
    ) {
    }
}
