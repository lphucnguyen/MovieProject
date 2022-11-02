<?php

namespace App\Http\Controllers;

use App\Film;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    //
    public function store(Film $film, Request $request)
    {
        $attribute = $request->validate([
          'title' => 'required|string|max:20',
          'review' => 'required|string|max:150',
        ]);
        $result = $film->review(auth()->user(), $attribute['title'], $attribute['review']);
        session()->flash('create_review', 'Cám ơn bạn đã bình luận về phim');
        return back();
    }

    public function destroy(Film $film)
    {
        $film->deleteReview(auth()->user());
        session()->flash('delete_review', 'Bình luận của bạn đã bị xoá');
        return back();
    }
}
