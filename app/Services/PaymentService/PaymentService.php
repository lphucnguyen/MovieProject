<?php

namespace App\Services\PaymentService;

use App\Services\PaymentService\Entities\EntityProcess;
use App\Services\PaymentService\Entities\EntityTransaction;
use App\Services\PaymentService\Interfaces\ICheckableTransaction;
use App\Services\PaymentService\Interfaces\IProcessablePayment;

abstract class PaymentService implements 
        IProcessablePayment, ICheckableTransaction {

    public function process(EntityProcess $request){
        return;
    }

    public function statusTransaction(EntityTransaction $request){
        return;
    }
}