<?php

namespace App\Repositories\Eloquents;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ITransactionRepository;
use App\Transaction;

class TransactionRepository extends BaseRepository implements ITransactionRepository
{
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }
}
