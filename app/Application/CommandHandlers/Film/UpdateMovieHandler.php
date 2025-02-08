<?php

namespace App\Application\CommandHandlers\Film;

use App\Application\Commands\Film\UpdateMovieCommand;
use App\Domain\Repositories\IFilmRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateMovieHandler
{
    public function __construct(
        private IFilmRepository $repository
    ) {
    }

    public function handle(UpdateMovieCommand $command)
    {
        try {
            DB::beginTransaction();
            $uuid = $command->uuid;
            $data = $command->data;
            $film = $this->repository->getToUpdate($uuid);

            if ($data->poster) {
                $data->poster = $data->poster->store('film_posters');
            } else {
                unset($data->poster);
            }

            if ($data->background_cover) {
                $data->background_cover = $data->background_cover->store('film_background_covers');
            } else {
                unset($data->background_cover);
            }

            $attributes = $data->toArray();

            $film->update($attributes);
            $film->categories()->sync($attributes['categories']);
            $film->actors()->sync($attributes['actors']);

            $id = $film->id;
            $episodes = array_map(function ($url, $apiUrl) use ($id) {
                return [
                    'id' => str()->uuid(),
                    'url' => $url ? $url : '',
                    'api_url' => $apiUrl ? $apiUrl : '',
                    'film_id' => $id
                ];
            }, $attributes['url'], $attributes['api_url']);

            $film->episodes()->delete();
            $film->episodes()->insert($episodes);
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
