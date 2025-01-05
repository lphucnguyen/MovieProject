<?php

namespace App\Application\Commands\Rating;

class DeleteRatingCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
