<?php

namespace App\CommandHandlers\Film;

use App\Commands\Film\GetMoviesByCategoryNameCommand;
use App\Repositories\Contracts\IFilmRepository;

class GetMoviesByCategoryNameHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(GetMoviesByCategoryNameCommand $command)
    {
        $categories = $command->categories;
        $films = $this->repository->getFilmByCategoryName($categories);

        return $films;
    }
}
