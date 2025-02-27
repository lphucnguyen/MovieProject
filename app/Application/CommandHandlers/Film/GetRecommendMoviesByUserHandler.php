<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\GetRecommendMoviesByUserCommand;
use App\Domain\Repositories\IFilmRepositoryNeo;

class GetRecommendMoviesByUserHandler
{
    public function __construct(
        private IFilmRepositoryNeo $repository
    ) {
    }

    public function handle(GetRecommendMoviesByUserCommand $command)
    {
        return $this->repository->getRecommendByUser($command->userId);
    }
}
