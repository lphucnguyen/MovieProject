<?php

namespace App\Commands\Film;

class DeleteMovieCommand
{
    public function __construct(
        public string $uuid,
    ) {
    }
}
