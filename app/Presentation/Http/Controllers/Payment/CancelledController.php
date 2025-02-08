<?php

namespace App\Presentation\Http\Controllers\Payment;

use App\Presentation\Http\Controllers\Controller;

class CancelledController extends Controller
{
    public function __invoke()
    {
        if (session()->has('paymentIntentId')) {
            session()->forget('paymentIntentId');
        }

        if (session()->has('paymentPlatformName')) {
            session()->forget('paymentPlatformName');
        }

        if (session()->has('approvalId')) {
            session()->forget('approvalId');
        }

        return redirect()
            ->route('home')
            ->withErrors('You cancelled the payment.');
    }
}