<?php

namespace App\Application\Commands\Payment;

use App\Application\DTOs\Payment\PaypalDTO;
use App\Application\DTOs\Payment\StripeDTO;

class PayOldOrderCommand
{
    public function __construct(
        public StripeDTO | PaypalDTO $dto
    ) {
    }
}