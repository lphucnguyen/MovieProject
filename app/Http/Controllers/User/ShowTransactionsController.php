<?php

namespace App\Http\Controllers\User;

use App\Commands\User\GetTransactionsCommand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class ShowTransactionsController extends Controller
{
    public function __invoke()
    {
        $user = auth()->guard('web')->user();
        $getTransactionsCommand = new GetTransactionsCommand($user->id);
        $transactions = Bus::dispatch($getTransactionsCommand);

        return view('clients.transactions', compact('user', 'transactions'));
    }
}
