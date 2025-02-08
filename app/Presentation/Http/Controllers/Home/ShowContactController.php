<?php

namespace App\Presentation\Http\Controllers\Home;

use App\Presentation\Http\Controllers\Controller;

class ShowContactController extends Controller
{
    public function __invoke()
    {
        return view('contact.index');
    }
}