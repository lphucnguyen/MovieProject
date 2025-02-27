<?php

namespace App\Application\Commands\Film;

class GetEpisodesCommand
{
    public function __construct(
        public string $uuid
    ) {
    }
}
