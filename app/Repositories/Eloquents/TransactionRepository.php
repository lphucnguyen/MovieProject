<?php

namespace App\Repositories\Eloquents;

use App\Repositories\BaseRepository;
use App\Transaction;

class TransactionRepository extends BaseRepository
{
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }
}
