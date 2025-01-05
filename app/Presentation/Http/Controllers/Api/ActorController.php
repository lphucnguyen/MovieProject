<?php

namespace App\Presentation\Http\Controllers\Api;

use App\Domain\Models\Actor;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Resources\ActorShowResource;

class ActorController extends Controller
{
    //
    public function show(Actor $actor)
    {
        return (new ActorShowResource($actor))->additional([
            'status' => 'success',
            'code' => '200',
            'message' => 'Show one movie',
        ]);
    }
}
