<?php

namespace App\Observers;

use App\Neo4j\Connection;
use App\User;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $connection = new Connection();
        $client = $connection->getClient();
        
        $query = 'CREATE (u:Users{
                        id: $userId,
                        username: "'. $user->username .'",
                        email: "'. $user->email .'",
                        first_name: "'. $user->first_name .'",
                        last_name: "'. $user->last_name .'"
                    })';
        $param = [
            'userId' => $user->id,
        ];
        $client->run($query, $param);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $connection = new Connection();
        $client = $connection->getClient();

        $fieldsUpdated = $user->getChanges();
        foreach($fieldsUpdated as $key => $value) {
            $fileds[] = $key;
        }
        $array_same = array_intersect($fileds, $user->getFillable());
        if(count($array_same) === 0) return;

        $query = 'MATCH (u:Users{id: $userId})
                    SET u.first_name="'. $user->first_name .'",
                        u.last_name="'. $user->last_name .'"';
        $param = [
            'userId' => $user->id
        ];
        $client->run($query, $param);
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $connection = new Connection();
        $client = $connection->getClient();

        $query = 'MATCH (u:Users{id: $userId})
                    DETACH DELETE u';
        $param = [
            'userId' => $user->id,
        ];
        $client->run($query, $param);
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
