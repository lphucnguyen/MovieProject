<?php

namespace App\Presentation\Http\Controllers\Api;

use App\Presentation\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $login = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($login)) {
            $user = Auth::user();
            $token = $user->createToken('api access')->accessToken;

            return response([
                'status' => 'success',
                'message' => 'auth success',
                'token' => $token
            ]);
        }

        return response([
            'status' => 'error',
            'message' => 'auth fails',
        ]);
    }
}
