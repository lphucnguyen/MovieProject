<?php

namespace App\Application\DTOs\Payment;

use App\Shared\Application\DTOs\BaseDTO;

class StripeDTO extends BaseDTO {
    public string $plan_id;
    public int $amount;
    public string $payment_name;
    public string $payment_method;
    public string|null $order_id;
    public string $lock_owner;
}