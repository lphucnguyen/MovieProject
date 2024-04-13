<?php

namespace App\Services;

use App\Repositories\IRepository;

class BaseService implements IService
{
    public function __construct(
        private IRepository $repository
    ) {
    }

    public function get($uuid)
    {
        return $this->repository->get($uuid);
    }

    public function paginate($perPage)
    {
        return $this->repository->paginate($perPage);
    }

    public function search($keyword, $sort, $order, $perPage)
    {
        return;
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function update($uuid, $data)
    {
        return $this->repository->update($uuid, $data);
    }

    public function delete($uuid)
    {
        return $this->repository->delete($uuid);
    }
}
