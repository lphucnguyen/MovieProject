<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\DeleteMovieCommand;
use App\Domain\Repositories\IFilmRepository;

class DeleteMovieHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(DeleteMovieCommand $command)
    {
        $uuid = $command->uuid;
        $this->repository->delete($uuid);
    }
}
