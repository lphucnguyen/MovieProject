<?php

namespace App\CommandHandlers\Film;

use App\Commands\Film\ReviewMovieCommand;
use App\Repositories\Contracts\IFilmRepository;

class ReviewMovieHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(ReviewMovieCommand $command)
    {
        $uuid = $command->uuid;
        $film = $this->repository->get($uuid)->review(
            auth()->user(),
            $command->title,
            $command->review
        );

        return $film;
    }
}
