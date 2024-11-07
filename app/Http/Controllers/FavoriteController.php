<?php

namespace App\Http\Controllers;

use App\Commands\Film\AddToFavoriteCommand;
use App\Commands\Film\RemoveFromFavoriteCommand;
use Illuminate\Support\Facades\Bus;

class FavoriteController extends Controller
{
    public function store(string $uuid)
    {
        $addToFavoriteCommand = new AddToFavoriteCommand($uuid);
        $result = Bus::dispatch($addToFavoriteCommand);

        return $result;
    }

    public function destroy(string $uuid)
    {
        $removeFromFavoriteCommand = new RemoveFromFavoriteCommand($uuid);
        $result = Bus::dispatch($removeFromFavoriteCommand);

        return $result;
    }
}
