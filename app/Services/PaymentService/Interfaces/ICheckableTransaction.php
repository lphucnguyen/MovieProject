<?php

namespace App\Services\PaymentService\Interfaces;

use App\Services\PaymentService\Entities\EntityTransaction;

interface ICheckableTransaction {
    public function statusTransaction(EntityTransaction $request);
}