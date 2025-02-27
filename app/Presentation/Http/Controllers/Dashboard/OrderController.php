<?php

namespace App\Presentation\Http\Controllers\Dashboard;

use App\Application\Commands\Order\GetOrderCommand;
use App\Application\Commands\Order\GetOrdersCommand;
use App\Application\Commands\User\CancelOrderCommand;
use App\Application\DTOs\Order\GetOrdersDTO;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_orders,guard:admin'])->only('index');
        $this->middleware(['permission:update_orders,guard:admin'])->only(['edit', 'update']);
    }

    public function index(Request $request)
    {
        $getOrdersCommand = new GetOrdersCommand(GetOrdersDTO::fromRequest($request));
        $orders = Bus::dispatch($getOrdersCommand);

        return view('dashboard.orders.index', compact('orders'));
    }

    public function edit(string $uuid)
    {
        $getOrderCommand = new GetOrderCommand($uuid);
        $order = Bus::dispatch($getOrderCommand);

        return view('dashboard.orders.edit', compact('order'));
    }

    public function update(string $uuid)
    {
        Bus::dispatch(new CancelOrderCommand(
            $uuid
        ));

        return redirect()->back()->withSuccess(__("Huỷ đơn hàng thành công"));
    }
}
