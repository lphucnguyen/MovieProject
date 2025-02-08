<?php

namespace App\Presentation\Http\Controllers\Home;

use App\Application\Commands\Actor\GetActorsCommand;
use App\Application\Commands\Film\GetMoviesCommand;
use App\Application\DTOs\Film\GetMoviesDTO;
use App\Application\Enums\Home\SearchCategory;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Home\SearchRequest;
use Illuminate\Support\Facades\Bus;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request)
    {
        switch ($request->search_category) {
            case SearchCategory::FILM->value:
                $getFilmsCommand = new GetMoviesCommand(GetMoviesDTO::fromRequest($request));
                $films = Bus::dispatch($getFilmsCommand);

                return view('movies.index', compact('films'));
                break;
            case SearchCategory::ACTOR->value:
                $getActorsCommand = new GetActorsCommand($request->searchKey, null);
                $actors = Bus::dispatch($getActorsCommand);

                return view('actors.index', compact('actors'));
                break;
            default:
                return redirect()->back();
                break;
        }
    }
}