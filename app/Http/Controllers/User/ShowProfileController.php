<?php

namespace App\Http\Controllers\User;

use App\Commands\User\GetTransactionsCommand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class ShowProfileController extends Controller
{
    public function __invoke()
    {
        $user = auth()->guard('web')->user();
        $getTransactionsCommand = new GetTransactionsCommand($user->id);
        $transaction = Bus::dispatch($getTransactionsCommand);

        return view(
            'clients.profile',
            compact(
                'user',
                'transaction',
            )
        );
    }
}
