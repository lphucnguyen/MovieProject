<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\GetMoviesByCategoryNameCommand;
use App\Domain\Repositories\IFilmRepository;

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
