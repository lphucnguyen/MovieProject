<?php

namespace App\Presentation\Http\Controllers\Api;

use App\Presentation\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return $request->user();
    }
}
