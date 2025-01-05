<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\ReviewMovieCommand;
use App\Domain\Repositories\IFilmRepository;

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
