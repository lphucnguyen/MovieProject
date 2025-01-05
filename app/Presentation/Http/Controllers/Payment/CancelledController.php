<?php

namespace App\Presentation\Http\Controllers\Payment;

use App\Presentation\Http\Controllers\Controller;

class CancelledController extends Controller
{
    public function __invoke()
    {
        return view('approval');
    }
}