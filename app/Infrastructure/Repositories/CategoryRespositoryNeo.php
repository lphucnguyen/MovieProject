<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\CategoryNeoModel;
use App\Domain\Repositories\ICategoryRepositoryNeo;
use App\Shared\Infrastructure\Repositories\BaseRepositoryNeo;

class CategoryRepositoryNeo extends BaseRepositoryNeo implements ICategoryRepositoryNeo
{
    public function __construct(
        private CategoryNeoModel $model
    ) {
        parent::__construct($model);
    }

    // public function create($id, $categoryName)
    // {
    //     $query = 'CREATE (c:Categories{
    //         id: $categoryId,
    //         name: "$categoryName"
    //     })';

    //     $param = [
    //         'categoryId' => $id,
    //         'categoryName' => $categoryName
    //     ];

    //     $client = $this->model->getClient();
    //     $client->run($query, $param);
    // }

    // public function update($id, $categoryName) {
    //     $query = 'MATCH (c:Categories{id: $categoryId})
    //                 SET c.name="' . $categoryName . '"';

    //     $param = [
    //         'categoryId' => $id,
    //     ];

    //     $client = $this->model->getClient();
    //     $client->run($query, $param);
    // }

    // public function delete($id) {
    //     $query = 'MATCH (c:Categories{id: $categoryId})
    //                 DETACH DELETE c';
    //     $param = [
    //         'categoryId' => $id,
    //     ];

    //     $client = $this->model->getClient();
    //     $client->run($query, $param);
    // }
}