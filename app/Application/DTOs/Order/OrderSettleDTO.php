<?php

namespace App\Application\DTOs\Order;

use App\Shared\Application\DTOs\BaseDTO;

class OrderSettleDTO extends BaseDTO {
    public string $id;
    public string $transaction_id;
    public string $payment_name;
}