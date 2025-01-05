<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\RemoveFromFavoriteCommand;
use App\Domain\Repositories\IFilmRepository;

class RemoveFromFavoriteHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(RemoveFromFavoriteCommand $command)
    {
        $uuid = $command->uuid;
        $film = $this->repository->get($uuid)->removeFromFavorite(
            auth()->user()
        );

        return $film;
    }
}
