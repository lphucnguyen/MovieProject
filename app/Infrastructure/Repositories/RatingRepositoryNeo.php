<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\RatingNeoModel;
use App\Domain\Repositories\IRatingRepositoryNeo;

class RatingRepositoryNeo implements IRatingRepositoryNeo
{
    public function __construct(
        protected RatingNeoModel $model
    ) {
    }

    public function create($filmId, $userId, $rating)
    {
        $query = 'MATCH (u:Users{id: $userId})-[r:RATED]->(f:Films{id: $filmId})
                    SET r.rating = $rating
                    RETURN r';
        $param = [
            'filmId' => $filmId,
            'userId' => $userId,
            'rating' => $rating
        ];

        $client = $this->model->getClient();
        $client->run($query, $param);
    }

    public function update($filmId, $userId, $rating) {
        $client = $this->model->getClient();

        $query = 'MATCH (u:Users{id: $userId})-[r:RATED]->(f:Films{id: $filmId}) DELETE r';

        $param = [
            'filmId' => $filmId,
            'userId' => $userId
        ];
        $client->run($query, $param);

        $query = 'MERGE (u1:Users{id: $userId})
                    MERGE (f1:Films{id: $filmId})
                    MERGE (u1)-[r1:RATED {user_id: $userId, film_id: $filmId,
                    rating: $rating}]->(f1)
                    RETURN type(r1)';

        $param = [
            'filmId' => $filmId,
            'userId' => $userId,
            'rating' => intval($rating)
        ];

        $client->run($query);
    }

    public function delete($userId, $filmId) {
        $query = 'MATCH (u:Users{id: $userId})-[r:RATED]->(f:Films{id: $filmId})
                    DELETE r';
        $param = [
            'filmId' => $filmId,
            'userId' => $userId,
        ];

        $client = $this->model->getClient();
        $client->run($query, $param);
    }
}