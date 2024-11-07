<?php

namespace App\Http\Controllers;

use App\Commands\Film\RateMovieCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class RateController extends Controller
{
    public function store(string $uuid, Request $request)
    {
        $rateMovieCommand = new RateMovieCommand($uuid, $request->rating);
        $result = Bus::dispatch($rateMovieCommand);

        return $result;
    }
}
