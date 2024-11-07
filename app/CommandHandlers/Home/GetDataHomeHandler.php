<?php

namespace App\CommandHandlers\Home;

use App\Commands\Home\GetDataHomeCommand;
use App\DTOs\Film\GetMoviesDTO;
use App\DTOs\Home\GetDataHomeReponse;
use App\Repositories\Contracts\ICategoryRepository;
use App\Repositories\Contracts\IFilmRepository;

class GetDataHomeHandler
{
    private int $MAX_MOVIE_PER_CATEGORY = 10;

    public function __construct(
        private IFilmRepository $filmRepository,
        private ICategoryRepository $categoryRepository
    ) {
    }

    public function handle(GetDataHomeCommand $command)
    {
        $getMoviesDTO = new GetMoviesDTO();
        $sliderFilms = $this->filmRepository->getFilmsByQueryParams($getMoviesDTO->toArray());
        $categoryWithFilms = $this->categoryRepository->getLatestCategoriesWithFilms(
            config('app.perPage'),
            $this->MAX_MOVIE_PER_CATEGORY
        );
        $suggestedFilms = [];
        $ratings = [];
        $user = auth()->guard('web')->user();

        // if ($user != null) {
        //     $connection = new Connection();
        //     $client = $connection->getClient();
        //     $query = 'MATCH (c1:Users {id:$userId})-[r1:RATED]->(f:Films)<-[r2:RATED]-(c2:Users)
        //                 WITH
        //                     SUM(r1.rating*r2.rating) as dot_product,
        //                     SQRT( REDUCE(x=0.0, a IN COLLECT(r1.rating) | x + a^2) ) as r1_length,
        //                     SQRT( REDUCE(y=0.0, b IN COLLECT(r2.rating) | y + b^2) ) as r2_length,
        //                     c1,c2
        //                 MERGE (c1)-[s:SIMILARITY]-(c2)
        //                 SET s.similarity = dot_product / (r1_length * r2_length)
        //                 WITH 1 as neighbours
        //                 MATCH (c1)-[:SIMILARITY]->(c2)-[r:RATED]->(f2:Films)
        //                 WHERE NOT (c1)-[:RATED]->(f2)
        //                 WITH f2, collect(r) as ratings ,c2, c1
        //                 WITH f2, c2, REDUCE(s=0,i in ratings | s+i.rating) / SIZE(ratings) as recommendation, c1
        //                 RETURN f2, recommendation
        //                 ORDER BY recommendation DESC
        //                 LIMIT 10';
        //     $param = ['userId' => $user->id];
        //     $results = $client->run($query, $param);
        //     foreach ($results as $result) {
        //         $node = $result->get('f2');
        //         $ratings[] = $result->get('recommendation');
        //         $suggestedFilms[] = $node;
        //     }
        // }

        return new GetDataHomeReponse([
            'sliderFilms' => $sliderFilms,
            'categoryFilms' => $categoryWithFilms,
            'suggestedFilms' => $suggestedFilms,
            'ratings' => $ratings,
            'user' => $user,
        ]);
    }
}
