<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\FilmNeoModel;
use App\Domain\Repositories\IFilmRepositoryNeo;
use App\Shared\Infrastructure\Repositories\BaseRepositoryNeo;

class FilmRepositoryNeo extends BaseRepositoryNeo implements IFilmRepositoryNeo
{
    public function __construct(
        FilmNeoModel $model
    ) {
        parent::__construct($model);
    }

    public function getRecommendByUser($userId)
    {
        $recommendations = [];
        $ratings = [];

        $client = $this->model->getClient();
        $query = 'MATCH (c1:Users {id:$userId})-[r1:RATED]->(f:Films)<-[r2:RATED]-(c2:Users)
                        WITH
                            SUM(r1.rating*r2.rating) as dot_product,
                            SQRT( REDUCE(x=0.0, a IN COLLECT(r1.rating) | x + a^2) ) as r1_length,
                            SQRT( REDUCE(y=0.0, b IN COLLECT(r2.rating) | y + b^2) ) as r2_length,
                            c1,c2
                        MERGE (c1)-[s:SIMILARITY]-(c2)
                        SET s.similarity = dot_product / (r1_length * r2_length)
                        WITH 1 as neighbours
                        MATCH (c1)-[:SIMILARITY]->(c2)-[r:RATED]->(f2:Films)
                        WHERE NOT (c1)-[:RATED]->(f2)
                        WITH f2, collect(r) as ratings ,c2, c1
                        WITH f2, c2, REDUCE(s=0,i in ratings | s+i.rating) / SIZE(ratings) as recommendation, c1
                        RETURN f2, recommendation
                        ORDER BY recommendation DESC
                        LIMIT 10';

        $param = ['userId' => $userId];
        $results = $client->run($query, $param);

        foreach ($results as $result) {
            $node = $result->get('f2');
            $ratings[] = $result->get('recommendation');
            $recommendations[] = $node;
        }

        return [
            'suggestedFilms' => $recommendations,
            'ratings' => $ratings
        ];
    }

    public function getRecommendByFilm($filmId)
    {
        $recommendations = [];
        $ratings = [];

        $client = $this->model->getClient();
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

        $param = ['filmId' => $filmId];
        $results = $client->run($query, $param);

        foreach ($results as $result) {
            $node = $result->get('f2');
            $ratings[] = $result->get('recommendation');
            $recommendations[] = $node;
        }

        return [
            'suggestedFilms' => $recommendations,
            'ratings' => $ratings
        ];
    }
}