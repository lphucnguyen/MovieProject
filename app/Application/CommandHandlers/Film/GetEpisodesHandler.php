<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\GetEpisodesCommand;
use App\Domain\Repositories\IFilmRepository;

class GetEpisodesHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(GetEpisodesCommand $command)
    {
        $uuid = $command->uuid;

        return $this->repository->getEpisodes($uuid);
    }
}
