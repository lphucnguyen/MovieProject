<?php

namespace App\Presentation\Http\Controllers\Actor;

use App\Application\Commands\Actor\GetActorsCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class ShowActorsController extends Controller
{
    public function __invoke()
    {
        $getActorsCommand = new GetActorsCommand(null, null);
        $getActorsDTO = Bus::dispatch($getActorsCommand);

        return view('actors.index', [
            'actors' => $getActorsDTO
        ]);
    }
}
