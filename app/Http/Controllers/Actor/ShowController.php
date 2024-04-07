<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Film;
use App\Services\Contracts\IActorService;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function __construct(
        private IActorService $actorService
    ) {
    }

    public function __invoke()
    {
        $actors = Actor::latest()->paginate(10);

        return view('actors.index', compact('actors'));
    }
}
