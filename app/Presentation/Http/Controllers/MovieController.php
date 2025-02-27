<?php

namespace App\Presentation\Http\Controllers;

use App\Application\Commands\Film\GetMoviesByCategoryNameCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $getMoviesByCategoryNameCommand = new GetMoviesByCategoryNameCommand((array) $request->category);
        $films = Bus::dispatch($getMoviesByCategoryNameCommand);

        return view('movies.index', compact('films'));
    }
}
