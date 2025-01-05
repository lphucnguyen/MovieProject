<?php

namespace App\Infrastructure\Repositories;


use App\Domain\Repositories\ITransactionRepository;
use App\Domain\Models\Transaction;

class TransactionRepository extends BaseRepository implements ITransactionRepository
{
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }
}
