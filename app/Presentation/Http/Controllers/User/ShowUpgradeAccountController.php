<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\Plan\GetPlansCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class ShowUpgradeAccountController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $getPlansCommand = new GetPlansCommand($user->uuid);
        $plans = Bus::dispatch($getPlansCommand);

        return view('clients.upgrade_account', compact('user', 'plans'));
    }
}
