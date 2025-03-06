<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\Film\ReviewMovieCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class AddReviewController extends Controller
{
    public function __invoke(string $uuid, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:20',
            'review' => 'required|string|max:150',
        ]);

        $reviewMovieCommand = new ReviewMovieCommand($uuid, $request->title, $request->review);
        Bus::dispatch($reviewMovieCommand);

        session()->flash('create_review', 'Cám ơn bạn đã bình luận về phim');
        return back();
    }
}
