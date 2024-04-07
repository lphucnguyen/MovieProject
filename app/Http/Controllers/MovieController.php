<?php

namespace App\Http\Controllers;

use App\Film;
use App\Neo4j\Connection;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $films = Film::where(function ($query) use ($request) {
            $query->when($request->category, function ($q) use ($request) {
                return $q->whereHas('categories', function ($q2) use ($request) {
                    return $q2->whereIn('name', (array)$request->category);
                });
            });
        })->latest()->paginate(10);

        return view('movies.index', compact('films'));
    }

    public function show(Film $film)
    {
        $user = auth()->guard('web')->user();
        $reviews = $film->reviews()->latest()->paginate(10);

        $suggestedFilms = [];
        $ratings = [];

        $connection = new Connection();
        $client = $connection->getClient();
        $query = 'MATCH(f1:Films{id: $filmId})-[fc1:HAS_CATEGORY]->(c:Categories)<-[fc2:HAS_CATEGORY]-(f2:Films)
                    WITH f1, f2, COUNT(c) AS intersection
                    MATCH (f1)-[:HAS_CATEGORY]->(sc:Categories)
                    WITH f1, f2, intersection, COLLECT(sc.id) AS s1
                    MATCH (u:Users)-[r:RATED]->(f2)-[:HAS_CATEGORY]->(zc:Categories)
                    WITH f1, f2, s1, intersection, COLLECT(zc.id) AS s2, collect(r) as ratings
                    WITH f1, f2, intersection, s1+[x IN s2 WHERE NOT x IN s1] AS union, s1, s2, toFloat(REDUCE(s=0,i in ratings | s+i.rating) / SIZE(ratings)) as recommendation
                    RETURN f2, ((1.0*intersection)/SIZE(union)) AS jaccard, recommendation
                    ORDER BY jaccard DESC, recommendation DESC, toFloat(f2.year) DESC
                    LIMIT 10';
        $param = ['filmId' => $film->id];
        $results = $client->run($query, $param);

        foreach ($results as $result) {
            $node = $result->get('f2');
            $ratings[] = $result->get('recommendation');
            $suggestedFilms[] = $node;
        }

        return view('movies.show', compact('film', 'reviews', 'suggestedFilms', 'ratings'));
    }
}
