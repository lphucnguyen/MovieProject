<?php

namespace App\Presentation\Http\Controllers\Payment;

use App\Presentation\Http\Controllers\Controller;

class CancelledController extends Controller
{
    public function __invoke()
    {
        $lock = cache()->lock(auth()->user()->id . ':payment:send', 120);

        if ($lock->get()) {
            $lock->release();
        }

        return redirect()
            ->route('home')
            ->withErrors('You cancelled the payment.');
    }
}