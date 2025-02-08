<?php

namespace App\Presentation\Http\Controllers\Payment;

use App\Application\Commands\Payment\PayNewOrderCommand;
use App\Application\Commands\Payment\PayOldOrderCommand;
use App\Application\DTOs\Payment\PaypalDTO;
use App\Application\DTOs\Payment\StripeDTO;
use App\Application\Enums\Payment\PaymentName;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Payment\PayRequest;
use Illuminate\Support\Facades\Bus;

class PayController extends Controller
{
    public function __invoke(PayRequest $request)
    {
        $request->validated();

        if ($request->payment_name === PaymentName::PAYPAL->value) {
            $dto = PaypalDTO::fromRequest($request);
        } else if ($request->payment_name === PaymentName::STRIPE->value) {
            $dto = StripeDTO::fromRequest($request);
        }

        if ($request->has('order_id')) {
            $command = new PayOldOrderCommand($dto);
        } else {
            $command = new PayNewOrderCommand($dto);
        }

        return Bus::dispatch($command);
    }
}