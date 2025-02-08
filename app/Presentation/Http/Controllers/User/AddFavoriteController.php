<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\Film\AddToFavoriteCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class AddFavoriteController extends Controller
{
    public function __invoke(string $uuid)
    {
        $addToFavoriteCommand = new AddToFavoriteCommand($uuid);
        $result = Bus::dispatch($addToFavoriteCommand);

        return $result;
    }
}
