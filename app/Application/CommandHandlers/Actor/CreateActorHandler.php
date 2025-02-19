<?php

namespace App\Application\CommandHandlers\Actor;

use App\Application\Commands\Actor\CreateActorCommand;
use App\Domain\Repositories\IActorRepository;

class CreateActorHandler
{
    public function __construct(
        private IActorRepository $repository
    ) {
    }

    public function handle(CreateActorCommand $command)
    {
        $data = $command->data;
        $parts = explode("/", $data->avatar);
        $file = implode('/', array_slice($parts, -2));
        $data->avatar = $file;

        $parts = explode("/", $data->background_cover);
        $file = implode('/', array_slice($parts, -2));
        $data->background_cover = $file;

        $data->overview = strip_tags($data->overview, config('app.allowTags'));
        $data->biography = strip_tags($data->biography, config('app.allowTags'));

        $this->repository->create($data->toArray());
    }
}
