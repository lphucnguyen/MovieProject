<?php

namespace App\Application\DTOs\Home;

use App\Application\DTOs\BaseDTO;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class GetDataHomeReponse extends BaseDTO
{
    public LengthAwarePaginator $sliderFilms;
    public Collection $categoryFilms;
    public array $suggestedFilms;
    public array $ratings;
    public Authenticatable|null $user;
}
