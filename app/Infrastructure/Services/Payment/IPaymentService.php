<?php

namespace App\Infrastructure\Services\Payment;

use App\Shared\Application\DTOs\BaseDTO;

interface IPaymentService
{
    public function handlePayment(BaseDTO $paymentDTO);

    public function cancelPayment(string $paymentIntentId);

    public function refundPayment(string $paymentIntentId);
}
