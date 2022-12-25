<?php

namespace App\Observers;

use App\Neo4j\Connection;
use App\Rating;

class RatingFilmObserver
{
    /**
     * Handle the rating "created" event.
     *
     * @param  \App\Rating  $rating
     * @return void
     */
    public function created(Rating $rating)
    {
        $connection = new Connection();
        $client = $connection->getClient();

        $query = 'MATCH (u:Users{id: $userId})-[r:RATED]->(f:Films{id: $filmId})
                    SET r.rating = '. $rating->rating. '
                    RETURN r';
        $param = [
            'filmId' => $rating->film_id,
            'userId' => $rating->user_id,
        ];
        $client->run($query, $param);
    }

    /**
     * Handle the rating "updated" event.
     *
     * @param  \App\Rating  $rating
     * @return void
     */
    public function updated(Rating $rating)
    {
        $connection = new Connection();
        $client = $connection->getClient();

        $query = 'MATCH (u:Users{id: '. $rating->user_id .'})-[r:RATED]->(f:Films{id: '. $rating->film_id .'}) DELETE r';
        $client->run($query);
        $query = 'MERGE (u1:Users{id: '. $rating->user_id .'})
                    MERGE (f1:Films{id: '. $rating->film_id .'})
                    MERGE (u1)-[r1:RATED {user_id: '. $rating->user_id .', film_id: '. $rating->film_id .', rating: '. intval($rating->rating) .'}]->(f1)
                    RETURN type(r1)';               
        $client->run($query);

    }

    /**
     * Handle the rating "deleted" event.
     *
     * @param  \App\Rating  $rating
     * @return void
     */
    public function deleted(Rating $rating)
    {
        $connection = new Connection();
        $client = $connection->getClient();
        
        $query = 'MATCH (u:Users{id: $userId})-[r:RATED]->(f:Films{id: $filmId})
                    DELETE r';
        $param = [
            'filmId' => $rating->film_id,
            'userId' => $rating->user_id,
        ];
        $client->run($query, $param);
    }

    /**
     * Handle the rating "restored" event.
     *
     * @param  \App\Rating  $rating
     * @return void
     */
    public function restored(Rating $rating)
    {
        //
    }

    /**
     * Handle the rating "force deleted" event.
     *
     * @param  \App\Rating  $rating
     * @return void
     */
    public function forceDeleted(Rating $rating)
    {
        //
    }
}
