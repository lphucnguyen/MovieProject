<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\User\GetFavoritesCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class ShowFavoritesController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $getFavoritesCommand = new GetFavoritesCommand($user->id);
        $favorites = Bus::dispatch($getFavoritesCommand);

        return view('clients.favorites', compact('user', 'favorites'));
    }
}
