<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\Film\RateMovieCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class AddRateController extends Controller
{
    public function __invoke(string $uuid, Request $request)
    {
        $rateMovieCommand = new RateMovieCommand($uuid, $request->rating);
        $result = Bus::dispatch($rateMovieCommand);

        return $result;
    }
}
