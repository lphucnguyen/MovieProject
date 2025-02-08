<?php

namespace App\Shared\Infrastructure\Repositories;

use App\Shared\Domain\Models\NeoModel;
use App\Shared\Domain\Repositories\IRepositoryNeo;

class BaseRepositoryNeo implements IRepositoryNeo
{
    public function __construct(
        protected NeoModel $model
    ) {
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($uuid, $data)
    {
        return $this->model->update($uuid, $data);
    }

    public function delete($uuid)
    {
        return $this->model->delete($uuid);
    }

    public function getClient()
    {
        return $this->model->getClient();
    }
}
