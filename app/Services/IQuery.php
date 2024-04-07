<?php

namespace App\Services;

interface IQuery
{
    public function get($uuid);
    public function paginate($perPage);
    public function search($keyword, $sort, $order, $perPage);
}
