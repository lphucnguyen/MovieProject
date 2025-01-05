<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\Review\GetReviewsCommand;
use App\Presentation\Http\Controllers\Controller;
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
