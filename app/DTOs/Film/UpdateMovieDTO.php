<?php

namespace App\DTOs\Film;

use App\DTOs\BaseDTO;
use Illuminate\Http\UploadedFile;

class UpdateMovieDTO extends BaseDTO
{
    public string $name;
    public string $year;
    public string $overview;
    public UploadedFile|string|null $background_cover = null;
    public UploadedFile|string|null $poster = null;
    public array $url;
    public array $api_url;
    public string $type_film;
    public array $categories;
    public array $actors;
}
