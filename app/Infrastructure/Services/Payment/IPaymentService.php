<?php

namespace App\Infrastructure\Services\Payment;

use App\Application\DTOs\BaseDTO;

interface IPaymentService
{
    public function handlePayment(BaseDTO $paymentDTO);
}
