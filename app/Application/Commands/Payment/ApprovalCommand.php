<?php

namespace App\Application\Commands\Payment;

use App\Application\DTOs\Payment\ApprovalPaymentPaypalDTO;
use App\Application\DTOs\Payment\ApprovalPaymentStripeDTO;

class ApprovalCommand
{
    public function __construct(
        public ApprovalPaymentStripeDTO|ApprovalPaymentPaypalDTO $dto
    ) {
    }
}
