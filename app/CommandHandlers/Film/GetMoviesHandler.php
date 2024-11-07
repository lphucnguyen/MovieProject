<?php

namespace App\CommandHandlers\Film;

use App\Commands\Film\GetMoviesCommand;
use App\Repositories\Contracts\IFilmRepository;

class GetMoviesHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(GetMoviesCommand $command)
    {
        $queryParam = $command->queryParam;

        return $this->repository->getFilmsByQueryParams(
            $queryParam->toArray()
        );
    }
}
