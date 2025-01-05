<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\RateMovieCommand;
use App\Domain\Repositories\IFilmRepository;

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
