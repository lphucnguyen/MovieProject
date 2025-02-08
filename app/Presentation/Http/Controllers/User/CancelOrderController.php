<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\User\CancelOrderCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class CancelOrderController extends Controller
{
    public function __invoke(string $orderId)
    {
        $cancelOrderCommand = new CancelOrderCommand($orderId);
        return Bus::dispatch($cancelOrderCommand);
    }
}
