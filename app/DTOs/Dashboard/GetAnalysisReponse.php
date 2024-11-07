<?php

namespace App\DTOs\Dashboard;

use App\DTOs\BaseDTO;

class GetAnalysisReponse extends BaseDTO
{
    public int $admins;
    public int $clients;
    public int $films;
    public int $categories;
    public int $ratings;
    public int $reviews;
    public int $actors;
    public int $messages;
}
