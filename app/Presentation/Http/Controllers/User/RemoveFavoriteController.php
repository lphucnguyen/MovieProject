<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\Film\RemoveFromFavoriteCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class RemoveFavoriteController extends Controller
{
    public function __invoke(string $uuid)
    {
        $removeFromFavoriteCommand = new RemoveFromFavoriteCommand($uuid);
        $result = Bus::dispatch($removeFromFavoriteCommand);

        return $result;
    }
}
