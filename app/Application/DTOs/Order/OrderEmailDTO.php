<?php

namespace App\Application\DTOs\Order;

use App\Shared\Application\DTOs\BaseDTO;

class OrderEmailDTO extends BaseDTO {
    public string $id;
    public string $created_at;
    public string $payment_name;
    public string $amount;
    public string $currency;
    public string $user_first_name;
    public string $user_last_name;
}