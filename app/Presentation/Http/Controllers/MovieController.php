<?php

namespace App\Presentation\Http\Controllers;

use App\Application\Commands\Film\GetMoviesByCategoryNameCommand;
use App\Application\Commands\Film\GetMovieWithReviewCommand;
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

    public function show(Request $request)
    {
        $getMovieWithReviewCommand = new GetMovieWithReviewCommand($request->uuid);
        $getMovieWithReviewDTO = Bus::dispatch($getMovieWithReviewCommand);

        $film = $getMovieWithReviewDTO->film;
        $reviews = $getMovieWithReviewDTO->reviews;

        $suggestedFilms = [];
        $ratings = [];

        // $connection = new Connection();
        // $client = $connection->getClient();
        // $query = 'MATCH(f1:Films{id: $filmId})-[fc1:HAS_CATEGORY]->(c:Categories)<-[fc2:HAS_CATEGORY]-(f2:Films)
        //             WITH f1, f2, COUNT(c) AS intersection
        //             MATCH (f1)-[:HAS_CATEGORY]->(sc:Categories)
        //             WITH f1, f2, intersection, COLLECT(sc.id) AS s1
        //             MATCH (u:Users)-[r:RATED]->(f2)-[:HAS_CATEGORY]->(zc:Categories)
        //             WITH f1, f2, s1, intersection, COLLECT(zc.id) AS s2, collect(r) as ratings
        //             WITH f1, f2, intersection, s1+[x IN s2 WHERE NOT x IN s1] AS union, s1, s2, toFloat(REDUCE(s=0,i in ratings | s+i.rating) / SIZE(ratings)) as recommendation
        //             RETURN f2, ((1.0*intersection)/SIZE(union)) AS jaccard, recommendation
        //             ORDER BY jaccard DESC, recommendation DESC, toFloat(f2.year) DESC
        //             LIMIT 10';
        // $param = ['filmId' => $film->id];
        // $results = $client->run($query, $param);

        // foreach ($results as $result) {
        //     $node = $result->get('f2');
        //     $ratings[] = $result->get('recommendation');
        //     $suggestedFilms[] = $node;
        // }

        return view('movies.show', compact('film', 'reviews', 'suggestedFilms', 'ratings'));
    }
}
