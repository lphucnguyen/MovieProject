<?php

namespace App\Presentation\Http\Controllers;

use App\Application\Commands\Actor\GetActorsCommand;
use App\Application\Commands\Film\GetMoviesCommand;
use App\Application\Commands\Home\GetDataHomeCommand;
use App\Application\Commands\Home\SendMessageCommand;
use App\Application\DTOs\Film\GetMoviesDTO;
use App\Application\DTOs\Home\SendMessageDTO;
use App\Application\Enums\Home\SearchCategory;
use App\Presentation\Http\Requests\Home\SearchRequest;
use App\Presentation\Http\Requests\Home\SendMessageRequest;
use Illuminate\Support\Facades\Bus;

class HomeController extends Controller
{
    public function index()
    {
        $getDataHomeCommand = new GetDataHomeCommand();
        $data = Bus::dispatch($getDataHomeCommand);

        $categoryFilms = $data->categoryFilms;
        $suggestedFilms = $data->suggestedFilms;
        $ratings = $data->ratings;
        $user = $data->user;

        return view('home', compact('data'));
    }

    public function search(SearchRequest $request)
    {
        switch ($request->search_category) {
            case SearchCategory::FILM->value:
                $getFilmsCommand = new GetMoviesCommand(GetMoviesDTO::fromRequest($request));
                $films = Bus::dispatch($getFilmsCommand);

                return view('movies.index', compact('films'));
                break;
            case SearchCategory::ACTOR->value:
                $getActorsCommand = new GetActorsCommand($request->search, null);
                $actors = Bus::dispatch($getActorsCommand);

                return view('actors.index', compact('actors'));
                break;
            default:
                return redirect()->back();
                break;
        }
    }

    public function message(SendMessageRequest $request)
    {
        $sendMessageCommand = new SendMessageCommand(
            SendMessageDTO::fromRequest($request)
        );
        Bus::dispatch($sendMessageCommand);

        session()->flash('success', 'Cám ơn bạn đã liên hệ');
        return redirect()->back();
    }

    public function contact()
    {
        return view('contact.index');
    }
}
