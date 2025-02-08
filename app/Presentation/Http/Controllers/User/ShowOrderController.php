<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\User\GetOrderCommand;
use App\Domain\Enums\Order\OrderStatus;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class ShowOrderController extends Controller
{
    public function __invoke(string $uuid)
    {
        $user = auth()->guard('web')->user();
        $getOrderCommand = new GetOrderCommand($uuid);
        $order = Bus::dispatch($getOrderCommand);

        $isCanPayOrCancel = $order->status == OrderStatus::COMPLETED || $order->status == OrderStatus::CANCELED;

        return view('clients.order', [
            'user' => $user,
            'order' => $order,
            'isCanPayOrCancel' => $isCanPayOrCancel
        ]);
    }
}
