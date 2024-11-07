<?php

namespace App\CommandHandlers\Film;

use App\Commands\Film\RateMovieCommand;
use App\Repositories\Contracts\IFilmRepository;

class RateMovieHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(RateMovieCommand $command)
    {
        $uuid = $command->uuid;
        $film = $this->repository->get($uuid)->rate(
            auth()->user(),
            $command->rating,
        );

        return $film;
    }
}
