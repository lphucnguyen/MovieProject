<?php

namespace App\Presentation\Http\Controllers\User;

use App\Application\Commands\Film\DeleteReviewCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class RemoveReviewController extends Controller
{
    public function __invoke(string $uuid)
    {
        $deleteReviewCommand = new DeleteReviewCommand($uuid);
        Bus::dispatch($deleteReviewCommand);

        session()->flash('delete_review', 'Bình luận của bạn đã bị xoá');
        return back();
    }
}
