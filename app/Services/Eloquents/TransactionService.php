<?php

namespace App\Services\Eloquents;

use App\Repositories\Contracts\ITransactionRepository;
use App\Services\BaseService;
use App\Services\IService;

class TransactionService extends BaseService implements IService
{
    public function __construct(ITransactionRepository $repository)
    {
        parent::__construct($repository);
    }
}
