<?php

namespace App\Http\Controllers\Api;

use App\Film;
use App\Http\Controllers\Controller;
use App\Http\Resources\MovieShowResource;

class MovieController extends Controller
{
    public function show(Film $movie)
    {
        return (new MovieShowResource($movie))->additional([
            'status' => 'success',
            'code' => '200',
            'message' => 'Show one movie',
        ]);
    }
}
