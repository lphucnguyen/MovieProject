<?php

namespace App\Services;

use App\Repositories\IRepository;

class BaseService implements IService
{
    public function __construct(
        private IRepository $model
    ) {
    }

    public function get($uuid)
    {
        return;
    }

    public function paginate($perPage)
    {
        return;
    }

    public function search($keyword, $sort, $order, $perPage)
    {
        return;
    }

    public function create($data)
    {
        return;
    }

    public function update($uuid, $data)
    {
        return;
    }

    public function delete($uuid)
    {
        return;
    }
}
