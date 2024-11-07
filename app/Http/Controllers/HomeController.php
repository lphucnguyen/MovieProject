<?php

namespace App\Http\Controllers;

use App\Commands\Actor\GetActorsCommand;
use App\Commands\Film\GetMoviesCommand;
use App\Commands\Home\GetDataHomeCommand;
use App\Commands\Home\SendMessageCommand;
use App\DTOs\Film\GetMoviesDTO;
use App\DTOs\Home\SendMessageDTO;
use App\Enums\Home\SearchCategory;
use App\Http\Requests\Home\SearchRequest;
use App\Http\Requests\Home\SendMessageRequest;
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
