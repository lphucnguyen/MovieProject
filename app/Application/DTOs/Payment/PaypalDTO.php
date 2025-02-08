<?php

namespace App\Application\DTOs\Payment;

use App\Shared\Application\DTOs\BaseDTO;

class PaypalDTO extends BaseDTO {
    public int $amount;
    public string $payment_name;
    public string $plan_id;
    public string|null $order_id;
    public string $lock_owner;
}