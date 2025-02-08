<?php

namespace App\Presentation\Http\Controllers\Home;

use App\Application\Commands\Film\GetMoviesByCategoryNameCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class ShowMoviesController extends Controller
{
    public function __invoke(Request $request)
    {
        $getMoviesByCategoryNameCommand = new GetMoviesByCategoryNameCommand((array) $request->category);
        $films = Bus::dispatch($getMoviesByCategoryNameCommand);

        return view('movies.index', compact('films'));
    }
}