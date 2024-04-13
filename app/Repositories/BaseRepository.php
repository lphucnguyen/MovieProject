<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IRepository
{
    protected $perPage = 10;

    public function __construct(
        private Model $model
    ) {
    }

    public function get($uuid)
    {
        return $this->model->findOrFail($uuid);
    }

    public function paginate($perPage)
    {
        return $this->model->latest()->paginate($perPage);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($uuid, $data)
    {
        return $this->model->findOrFail($uuid)->update($data);
    }

    public function delete($uuid)
    {
        return $this->model->findOrFail($uuid)->delete();
    }

    public function makeQuery()
    {
        return $this->model->query();
    }
}
