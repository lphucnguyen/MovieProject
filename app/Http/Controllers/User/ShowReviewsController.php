<?php

namespace App\Http\Controllers\User;

use App\Commands\Review\GetReviewsCommand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class ShowReviewsController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $getReviewsCommand = new GetReviewsCommand($user->uuid);
        $reviews = Bus::dispatch($getReviewsCommand);

        return view('clients.reviews', compact('user', 'reviews'));
    }
}
