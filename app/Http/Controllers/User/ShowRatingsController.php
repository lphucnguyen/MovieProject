<?php

namespace App\Http\Controllers\User;

use App\Commands\User\GetRatingsCommand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class ShowRatingsController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $getRatingsCommand = new GetRatingsCommand($user->id);
        $ratings = Bus::dispatch($getRatingsCommand);

        return view('clients.ratings', compact('user', 'ratings'));
    }
}
