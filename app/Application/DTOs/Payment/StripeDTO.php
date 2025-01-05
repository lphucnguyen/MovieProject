<?php

namespace App\Application\DTOs\Payment;

use App\Application\DTOs\BaseDTO;

class StripeDTO extends BaseDTO {
    public string $plan_id;
    public string $payment_name;
    public string $payment_method;
}