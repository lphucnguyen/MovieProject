<?php

namespace App\Http\Controllers\Actor;

use App\Http\Controllers\Controller;
use App\Services\Contracts\IActorService;

class ShowController extends Controller
{
    public function __construct(
        private IActorService $actorService
    ) {
    }

    public function __invoke()
    {
        $actors = $this->actorService->paginate(10);

        return view('actors.index', compact('actors'));
    }
}
