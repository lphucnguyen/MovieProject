<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\UserNeoModel;
use App\Domain\Repositories\IUserRepositoryNeo;
use App\Shared\Infrastructure\Repositories\BaseRepositoryNeo;

class UserRepositoryNeo extends BaseRepositoryNeo implements IUserRepositoryNeo
{
    public function __construct(
        private UserNeoModel $model
    ) {
        parent::__construct($model);
    }

    // public function create(array $data) {
    //     // $query = 'CREATE (u:Users{
    //     //                 id: $userId,
    //     //                 username: "$username",
    //     //                 email: "$email",
    //     //                 first_name: "$firstName",
    //     //                 last_name: "$lastName"
    //     //             })';
    //     // $param = [
    //     //     'userId' => $id,
    //     //     'username' => $username,
    //     //     'email' => $email,
    //     //     'firstName' => $firstName,
    //     //     'lastName' => $lastName
    //     // ];

    //     // $client = $this->model->getClient();
    //     // $client->run($query, $param);

    //     $this->model->create($data);
    // }

    // public function update($id, $data) {
    //     // $query = 'MATCH (u:Users{id: $userId})
    //     //             SET u.first_name="$firstName",
    //     //                 u.last_name="$lastName"';
    //     // $param = [
    //     //     'userId' => $id,
    //     //     'firstName' => $firstName,
    //     //     'lastName' => $lastName
    //     // ];

    //     // $client = $this->model->getClient();
    //     // $client->run($query, $param);

    //     $this->model->update($id, $data);
    // }

    // public function delete($id) {
    //     // $query = 'MATCH (u:Users{id: $userId})
    //     //             DETACH DELETE u';
    //     // $param = [
    //     //     'userId' => $id,
    //     // ];

    //     // $client = $this->model->getClient();
    //     // $client->run($query, $param);

    //     $this->model->delete($id);
    // }
}