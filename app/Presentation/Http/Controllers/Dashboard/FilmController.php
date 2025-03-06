<?php

namespace App\Presentation\Http\Controllers\Dashboard;

use App\Domain\Models\Actor;
use App\Domain\Models\Category;
use App\Application\Commands\Film\CreateMovieCommand;
use App\Application\Commands\Film\DeleteMovieCommand;
use App\Application\Commands\Film\GetMoviesCommand;
use App\Application\Commands\Film\UpdateMovieCommand;
use App\Application\DTOs\Film\CreateMovieDTO;
use App\Application\DTOs\Film\GetMoviesDTO;
use App\Application\DTOs\Film\UpdateMovieDTO;
use App\Domain\Models\Film;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Requests\Dashboard\CreateMovieRequest;
use App\Presentation\Http\Requests\Dashboard\UpdateMovieRequest;
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

        return redirect()->route('dashboard.films.index')->withSuccess(__('Phim thêm thành công'));
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

        return redirect()->route('dashboard.films.index')->withSuccess(__('Phim cập nhật thành công'));
    }

    public function destroy(string $uuid)
    {
        $deleteMovieCommand = new DeleteMovieCommand($uuid);
        Bus::dispatch($deleteMovieCommand);

        return redirect()->route('dashboard.films.index')->withSuccess(__('Phim xoá thành công'));
    }
}
