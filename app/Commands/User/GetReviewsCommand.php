<?php

namespace App\Commands\User;

class GetReviewsCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
