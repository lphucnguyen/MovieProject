<?php

namespace App\Observers;

use App\Category;
use App\Neo4j\Connection;

class CategoryObserver
{
    public function created(Category $category)
    {
        // $connection = new Connection();
        // $client = $connection->getClient();

        // $query = 'CREATE (c:Categories{
        //                 id: $categoryId,
        //                 name: "' . $category->name . '"
        //             })';
        // $param = [
        //     'categoryId' => $category->id,
        // ];
        // $client->run($query, $param);
    }

    public function updated(Category $category)
    {
        // $connection = new Connection();
        // $client = $connection->getClient();

        // $query = 'MATCH (c:Categories{id: $categoryId})
        //             SET c.name="' . $category->name . '"';

        // $param = [
        //     'categoryId' => $category->id,
        // ];
        // $client->run($query, $param);
    }

    public function deleted(Category $category)
    {
        // $connection = new Connection();
        // $client = $connection->getClient();

        // $query = 'MATCH (c:Categories{id: $categoryId})
        //             DETACH DELETE c';
        // $param = [
        //     'categoryId' => $category->id,
        // ];
        // $client->run($query, $param);
    }
}
