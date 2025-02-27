<?php

namespace App\Presentation\Http\Controllers\Home;

use App\Application\Commands\Film\GetMovieWithReviewCommand;
use App\Application\Commands\Film\GetRecommendMoviesByMovieCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class ShowMovieController extends Controller
{
    public function __invoke(string $uuid)
    {
        $getMovieWithReviewCommand = new GetMovieWithReviewCommand($uuid);
        $getMovieWithReviewDTO = Bus::dispatch($getMovieWithReviewCommand);

        $film = $getMovieWithReviewDTO->film;
        $reviews = $getMovieWithReviewDTO->reviews;

        $films = Bus::dispatch(new GetRecommendMoviesByMovieCommand($uuid));
        $suggestedFilms = $films['suggestedFilms'];
        $ratings = $films['ratings'];

        return view('movies.show', compact('film', 'reviews', 'suggestedFilms', 'ratings'));
    }
}