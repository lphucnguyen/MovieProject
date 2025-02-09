<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\Plan\GetPlansCommand;
use App\Application\Commands\User\GetOrderCommand;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\User\ShowUpgradeAccountRequest;
use Illuminate\Support\Facades\Bus;

class ShowUpgradeAccountController extends Controller
{
    public function __invoke(ShowUpgradeAccountRequest $request)
    {
        $user = auth()->user();
        $getPlansCommand = new GetPlansCommand($user->uuid);
        $plans = Bus::dispatch($getPlansCommand);

        $order = null;
        if ($request->orderId) {
            $getOrderCommand = new GetOrderCommand($request->orderId);
            $order = Bus::dispatch($getOrderCommand);

            for ($i = 0; $i < count($plans); $i++) {
                if ($plans[$i]->id === $order->plan_id) {
                    $order->plan = $plans[$i];
                    break;
                }
            }
        }

        $hasActiveSubscription = optional($user)->hasActiveSubscription();

        return view('clients.upgrade_account', [
            'user' => $user,
            'plans' => $plans,
            'order' => $order,
            'hasActiveSubscription' => $hasActiveSubscription,
        ]);
    }
}
