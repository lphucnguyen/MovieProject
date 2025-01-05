<?php

namespace App\Infrastructure\Services\Payment;

use App\Application\DTOs\BaseDTO;

class PaypalService implements IPaymentService
{
    public function handlePayment(BaseDTO $stripeDTO)
    {
        // Logic to handle payment with Paypal
    }
}
