<?php

namespace App\Presentation\Http\Controllers\Dashboard;

use App\Application\Commands\Review\DeleteReviewCommand;
use App\Application\Commands\Review\GetReviewsCommand;
use App\Domain\Models\Film;
use App\Presentation\Http\Controllers\Controller;
use App\Domain\Models\Review;
use App\Domain\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_reviews,guard:admin'])->only('index');
        $this->middleware(['permission:delete_reviews,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        $getReviewsCommand = new GetReviewsCommand($request->searchKey);
        $reviews = Bus::dispatch($getReviewsCommand);

        return view('dashboard.reviews.index', compact('reviews'));
    }

    public function destroy(string $uuid)
    {
        $deleteReviewCommand = new DeleteReviewCommand($uuid);
        Bus::dispatch($deleteReviewCommand);

        session()->flash('success', 'Bình luận xoá thành công');
        return redirect()->route('dashboard.reviews.index');
    }
}
