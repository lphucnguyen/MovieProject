<?php

namespace App\Http\Controllers\Actor;

use App\Commands\Actor\GetActorCommand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class GetActorController extends Controller
{
    public function __invoke($uuid)
    {
        $getActorCommand = new GetActorCommand($uuid);
        $getActorDTO = Bus::dispatch($getActorCommand);

        return $getActorDTO;
    }
}
