<?php

namespace App\Presentation\Http\Controllers\Actor;

use App\Application\Commands\Actor\GetActorCommand;
use App\Presentation\Http\Controllers\Controller;
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
