<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'invalid credentials'], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 60 * 2);
        return response([
            'messeage' => 'success'
        ])->withCookie($cookie);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        $cookie = Cookie::forget('jwt');
        
        return response()->json(['message' => 'Logged out'], 200)->withCookie($cookie);   
    }
}
