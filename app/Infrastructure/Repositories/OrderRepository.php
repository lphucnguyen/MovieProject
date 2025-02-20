<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Models\Order;
use App\Domain\Repositories\IOrderRepository;
use App\Shared\Infrastructure\Repositories\BaseRepository;

class OrderRepository extends BaseRepository implements IOrderRepository
{
    public function __construct(
        Order $model
    ) {
        parent::__construct($model);
    }

    public function getUnpaidOrder($limit)
    {
        return $this->model->whereNull('paid_at')->limit($limit)->get();
    }
}