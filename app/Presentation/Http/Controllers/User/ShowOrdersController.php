<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\User\GetOrdersCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class ShowOrdersController extends Controller
{
    public function __invoke()
    {
        $user = auth()->guard('web')->user();
        $getOrdersCommand = new GetOrdersCommand($user->id);
        $orders = Bus::dispatch($getOrdersCommand);

        return view('clients.orders', compact('user', 'orders'));
    }
}
