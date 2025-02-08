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

        return $recommendations;
    }
}