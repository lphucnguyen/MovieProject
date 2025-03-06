<?php

namespace App\Presentation\Http\Middleware;

use Closure;

class Unsubscribed
{
    public function handle($request, Closure $next)
    {
        if (optional($request->user())->hasActiveSubscription()) {
            return redirect()->route('home')->with('error', __('Hiện tại chưa tới kì hạn thanh toán'));
        }

        return $next($request);
    }
}
