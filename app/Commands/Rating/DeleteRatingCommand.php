<?php

namespace App\Commands\Rating;

class DeleteRatingCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
