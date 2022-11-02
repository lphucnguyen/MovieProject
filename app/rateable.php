<?php
/**
 * Created by PhpStorm.
 * User: jit
 * Date: 11/06/2020
 * Time: 03:00 م
 */

namespace App;

use App\Neo4j\Connection;

trait rateable
{
    public function rate($user, $rating)
    {
        $result = $this->ratings()->updateOrCreate(
            ['user_id' => $user->id, 'film_id' => $this->id],
            ['rating' => $rating]
        );
        $responce = array("status" => TRUE, "avg" => $this->ratings->avg('rating') ?? 0, "count" => $this->ratings->count() . ' Reviews');
        
        $connection = new Connection();
        $client = $connection->getClient();
        
        $query = 'MATCH (u:Users{id: '. $user->id .'})-[r:RATED]->(f:Films{id: '. $this->id .'})
                        DELETE r';
                        
        $param = [
            'filmId' => $this->id,
            'userId' => $user->id
        ];
        $client->run($query, $param);

        $query = 'MERGE (u1:Users{id: $userId})
                    MERGE (f1:Films{id: $filmId})
                    MERGE (u1)-[r1:RATED {user_id: '. $user->id .', film_id: '. $this->id .', rating: '. $rating .'}]->(f1)
                    RETURN type(r1)';               

        $param = [
            'filmId' => $this->id,
            'userId' => $user->id
        ];
        $client->run($query, $param);
        
        return $responce;
    }
}