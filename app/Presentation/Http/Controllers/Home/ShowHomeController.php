<?php

namespace App\Presentation\Http\Controllers\Home;

use App\Application\Commands\Home\GetDataHomeCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class ShowHomeController extends Controller
{
    public function __invoke()
    {
        $getDataHomeCommand = new GetDataHomeCommand();
        $data = Bus::dispatch($getDataHomeCommand);

        $categoryFilms = $data->categoryFilms;
        $suggestedFilms = $data->suggestedFilms;
        $ratings = $data->ratings;
        $user = $data->user;

        return view('home', compact('data'));
    }
}