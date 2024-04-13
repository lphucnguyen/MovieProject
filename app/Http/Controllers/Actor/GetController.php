<?php

namespace App\Http\Controllers\Actor;

use App\Http\Controllers\Controller;
use App\Services\Contracts\IActorService;

class GetController extends Controller
{
    public function __construct(
        private IActorService $actorService
    ) {
    }

    public function __invoke($uuid)
    {
        $actorWithFilms = $this->actorService->getActorWithFilms($uuid);
        $actor = $actorWithFilms->actor;
        $films = $actorWithFilms->films;

        return view('actors.show', compact('actor', 'films'));
    }
}
