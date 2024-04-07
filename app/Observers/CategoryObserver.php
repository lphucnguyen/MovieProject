<?php

namespace App\Observers;

use App\Category;
use App\Neo4j\Connection;

class CategoryObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function created(Category $category)
    {
        $connection = new Connection();
        $client = $connection->getClient();

        $query = 'CREATE (c:Categories{
                        id: $categoryId,
                        name: "' . $category->name . '"
                    })';
        $param = [
            'categoryId' => $category->id,
        ];
        $client->run($query, $param);
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function updated(Category $category)
    {
        $connection = new Connection();
        $client = $connection->getClient();

        $query = 'MATCH (c:Categories{id: $categoryId})
                    SET c.name="' . $category->name . '"';

        $param = [
            'categoryId' => $category->id,
        ];
        $client->run($query, $param);
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        $connection = new Connection();
        $client = $connection->getClient();

        $query = 'MATCH (c:Categories{id: $categoryId})
                    DETACH DELETE c';
        $param = [
            'categoryId' => $category->id,
        ];
        $client->run($query, $param);
    }

    /**
     * Handle the category "restored" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param  \App\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
