<?php

namespace App\Presentation\Http\Controllers\Payment;

use App\Application\DTOs\Payment\StripeDTO;
use App\Infrastructure\Services\Payment\PaymentResolver;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Payment\PayRequest;

class PayController extends Controller
{
    private PaymentResolver $paymentResolver;

    public function __construct(PaymentResolver $paymentResolver)
    {
        $this->paymentResolver = $paymentResolver;
    }

    public function __invoke(PayRequest $request)
    {
        $request->validated();

        $dto = StripeDTO::fromRequest($request);
        $paymentService = $this->paymentResolver->resolveService($dto->payment_name);

        session()->put('paymentPlatformName', $request->payment_name);

        if ($request->user()->hasActiveSubscription()) {
            $dto->value = round($request->value * 0.9, 2);
        }

        return $paymentService->handlePayment($dto);
    }
}