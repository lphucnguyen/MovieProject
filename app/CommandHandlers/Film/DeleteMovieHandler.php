<?php

namespace App\CommandHandlers\Film;

use App\Commands\Film\DeleteMovieCommand;
use App\Repositories\Contracts\IFilmRepository;

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
