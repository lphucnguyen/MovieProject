<?php

namespace App\Application\DTOs\Order;

use App\Shared\Application\DTOs\BaseDTO;

class GetOrdersDTO extends BaseDTO {
    public string|null $searchKey = null;
}