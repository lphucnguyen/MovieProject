<?php

namespace App\Shared\Infrastructure\Repositories;

use App\Shared\Domain\Repositories\IRepository;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IRepository
{
    public function __construct(
        protected Model $model
    ) {
    }

    public function all()
    {
        return $this->model->all();
    }

    public function count()
    {
        return $this->model->count();
    }

    public function get($uuid)
    {
        return $this->model->findOrFail($uuid);
    }

    public function getWithLock($uuid)
    {
        return $this->model->lockForUpdate()->findOrFail($uuid);
    }

    public function paginate($perPage = null)
    {
        if ($perPage === null) {
            $perPage = config('app.perPage');
        }
        return $this->model->latest()->paginate($perPage);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($uuid, $data)
    {
        return $this->model->lockForUpdate()->findOrFail($uuid)->update($data);
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
