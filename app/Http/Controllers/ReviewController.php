<?php

namespace App\Http\Controllers;

use App\Commands\Film\DeleteReviewCommand;
use App\Commands\Film\ReviewMovieCommand;
use App\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class ReviewController extends Controller
{
    public function store(string $uuid, Request $request)
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

    public function destroy(Film $film)
    {
        $deleteReviewCommand = new DeleteReviewCommand($film->uuid);
        Bus::dispatch($deleteReviewCommand);

        session()->flash('delete_review', 'Bình luận của bạn đã bị xoá');
        return back();
    }
}
