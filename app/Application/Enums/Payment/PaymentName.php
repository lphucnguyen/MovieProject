<?php

namespace App\Application\Enums\Payment;

enum PaymentName: string
{
    case PAYPAL = 'paypal';
    case STRIPE = 'stripe';
}
