<?php

namespace App\Application\DTOs\Film;

use App\Shared\Application\DTOs\BaseDTO;

class CreateMovieDTO extends BaseDTO
{
    public string $name;
    public string $year;
    public string $overview;
    public string|null $background_cover;
    public string|null $poster;
    public array $url;
    public array $api_url;
    public string $type_film;
    public array $categories;
    public array $actors;
}
