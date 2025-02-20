<?php

namespace App\Presentation\Http\Controllers\Dashboard;

use App\Application\Commands\Rating\DeleteRatingCommand;
use App\Application\Commands\Rating\GetRatingsCommand;
use App\Application\DTOs\Rating\GetRatingsDTO;
use App\Presentation\Http\Controllers\Controller;
use App\Infrastructure\Neo4j\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_ratings,guard:admin'])->only('index');
        $this->middleware(['permission:delete_ratings,guard:admin'])->only('destroy');
    }


    public function index(Request $request)
    {
        $getRatingsCommand = new GetRatingsCommand(GetRatingsDTO::fromRequest($request));
        $ratings = Bus::dispatch($getRatingsCommand);

        return view('dashboard.ratings.index', compact('ratings'));
    }

    public function destroy(string $uuid)
    {
        // $connection = new Connection();
        // $client = $connection->getClient();

        // $query = 'MATCH (u:Users{id: $userId})-[r:RATED]->(f:Films{id: $filmId})
        //             DELETE r';
        // $param = [
        //     'filmId' => $rating->film_id,
        //     'userId' => $rating->user_id,
        // ];
        // $client->run($query, $param);

        // $rating->delete();
        $deleteRatingCommand = new DeleteRatingCommand($uuid);
        Bus::dispatch($deleteRatingCommand);

        return redirect()->route('dashboard.ratings.index')->withSuccess(__('Đánh giá xoá thành công'));
    }
}
