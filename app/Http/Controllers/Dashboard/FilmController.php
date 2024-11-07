<?php

namespace App\Http\Controllers\Dashboard;

use App\Actor;
use App\Category;
use App\Commands\Film\CreateMovieCommand;
use App\Commands\Film\DeleteMovieCommand;
use App\Commands\Film\GetMoviesCommand;
use App\Commands\Film\UpdateMovieCommand;
use App\DTOs\Film\CreateMovieDTO;
use App\DTOs\Film\GetMoviesDTO;
use App\DTOs\Film\UpdateMovieDTO;
use App\Film;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateMovieRequest;
use App\Http\Requests\Dashboard\UpdateMovieRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class FilmController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create_films,guard:admin'])->only(['create', 'store']);
        $this->middleware(['permission:read_films,guard:admin'])->only('index');
        $this->middleware(['permission:update_films,guard:admin'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_films,guard:admin'])->only('destroy');
    }

    public function index(Request $request)
    {
        $categories = Category::all();
        $actors = Actor::all();

        $getMoviesDTO = GetMoviesDTO::fromRequest($request);
        $getMoviesCommand = new GetMoviesCommand($getMoviesDTO);
        $films = Bus::dispatch($getMoviesCommand);

        return view('dashboard.films.index', compact('films', 'categories', 'actors'));
    }

    public function create()
    {
        $categories = Category::all();
        $actors = Actor::all();

        return view('dashboard.films.create', compact('categories', 'actors'));
    }

    public function store(CreateMovieRequest $request)
    {
        $createMovieDTO = CreateMovieDTO::fromRequest($request);
        $createMovieCommand = new CreateMovieCommand($createMovieDTO);
        Bus::dispatch($createMovieCommand);

        session()->flash('success', 'Phim thêm thành công');
        return redirect()->route('dashboard.films.index');
    }

    public function edit(Film $film)
    {
        $categories = Category::all();
        $actors = Actor::all();
        return view('dashboard.films.edit', compact('film', 'categories', 'actors'));
    }

    public function update(string $uuid, UpdateMovieRequest $request)
    {
        $updateMovieDTO = UpdateMovieDTO::fromRequest($request);
        $updateMovieCommand = new UpdateMovieCommand($uuid, $updateMovieDTO);
        Bus::dispatch($updateMovieCommand);

        session()->flash('success', 'Phim cập nhật thành công');
        return redirect()->route('dashboard.films.index');
    }

    public function destroy(string $uuid)
    {
        $deleteMovieCommand = new DeleteMovieCommand($uuid);
        Bus::dispatch($deleteMovieCommand);

        session()->flash('success', 'Phim xoá thành công');
        return redirect()->route('dashboard.films.index');
    }
}
