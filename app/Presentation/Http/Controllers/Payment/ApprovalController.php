<?php

namespace App\Presentation\Http\Controllers\Payment;

use App\Infrastructure\Services\Payment\PaymentResolver;
use App\Presentation\Http\Controllers\Controller;

class ApprovalController extends Controller
{
    private PaymentResolver $paymentResolver;

    public function __construct(PaymentResolver $paymentResolver)
    {
        $this->paymentResolver = $paymentResolver;
    }

    public function __invoke()
    {
        if (session()->has('paymentPlatformName')) {
            $paymentPlatform = $this->paymentResolver
                ->resolveService(session()->get('paymentPlatformName'));

            return $paymentPlatform->handleApproval();
        }

        return redirect()
            ->route('user.upgrade-account')
            ->withErrors('We cannot retrieve your payment platform. Try again, please.');
    }
}