<?php

namespace App\Repositories;

interface IRepository
{
    public function all();

    public function count();

    public function get($uuid);

    public function paginate($perPage);

    public function create($data);

    public function update($uuid, $data);

    public function delete($uuid);

    public function makeQuery();
}
