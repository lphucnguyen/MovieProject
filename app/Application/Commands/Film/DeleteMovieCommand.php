<?php

namespace App\Application\Commands\Film;

class DeleteMovieCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
