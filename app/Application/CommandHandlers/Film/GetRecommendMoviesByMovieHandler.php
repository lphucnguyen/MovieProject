<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\GetRecommendMoviesByMovieCommand;
use App\Domain\Repositories\IFilmRepositoryNeo;

class GetRecommendMoviesByMovieHandler
{
    public function __construct(
        private IFilmRepositoryNeo $repository
    ) {
    }

    public function handle(GetRecommendMoviesByMovieCommand $command)
    {
        return $this->repository->getRecommendByFilm($command->filmId);
    }
}
