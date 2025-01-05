<?php

namespace App\Application\Commands\User;

class GetReviewsCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
