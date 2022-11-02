<?php

namespace App\Services\PaymentService\Interfaces;

use App\Services\PaymentService\Entities\EntityProcess;

interface IProcessablePayment {
    public function process(EntityProcess $request);
}