<?php

namespace App\Application\DTOs\Payment;

use App\Shared\Application\DTOs\BaseDTO;

class CreateOrderDTO extends BaseDTO {
    public string $amount;
    public string $currency;
    public string $paymentName;
}