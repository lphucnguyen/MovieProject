<?php

namespace App\Presentation\Http\Controllers\Api;

use App\Domain\Models\Film;
use App\Presentation\Http\Controllers\Controller;
use App\Presentation\Http\Resources\MovieShowResource;

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
