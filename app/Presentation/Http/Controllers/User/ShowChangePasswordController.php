<?php

namespace App\Presentation\Http\Controllers\User;

use App\Presentation\Http\Controllers\Controller;

class ShowChangePasswordController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        return view('clients.change_password', compact('user'));
    }
}
