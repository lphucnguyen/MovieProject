<?php

namespace App\Domain\Observers;

use App\Infrastructure\Neo4j\Connection;
use App\Domain\Models\Rating;

class RatingFilmObserver
{
    public function created(Rating $rating)
    {
        // $connection = new Connection();
        // $client = $connection->getClient();

        // $query = 'MATCH (u:Users{id: $userId})-[r:RATED]->(f:Films{id: $filmId})
        //             SET r.rating = ' . $rating->rating . '
        //             RETURN r';
        // $param = [
        //     'filmId' => $rating->film_id,
        //     'userId' => $rating->user_id,
        // ];
        // $client->run($query, $param);
    }

    public function updated(Rating $rating)
    {
        // $connection = new Connection();
        // $client = $connection->getClient();

        // $query = 'MATCH (u:Users{id: ' . $rating->user_id . '})-[r:RATED]->(f:Films{id: ' .
        // $rating->film_id . '}) DELETE r';

        // $client->run($query);
        // $query = 'MERGE (u1:Users{id: ' . $rating->user_id . '})
        //             MERGE (f1:Films{id: ' . $rating->film_id . '})
        //             MERGE (u1)-[r1:RATED {user_id: ' . $rating->user_id . ', film_id: ' . $rating->film_id .
        //             ', rating: ' . intval($rating->rating) . '}]->(f1)
        //             RETURN type(r1)';
        // $client->run($query);

    }

    public function deleted(Rating $rating)
    {
        // $connection = new Connection();
        // $client = $connection->getClient();

        // $query = 'MATCH (u:Users{id: $userId})-[r:RATED]->(f:Films{id: $filmId})
        //             DELETE r';
        // $param = [
        //     'filmId' => $rating->film_id,
        //     'userId' => $rating->user_id,
        // ];
        // $client->run($query, $param);
    }
}
