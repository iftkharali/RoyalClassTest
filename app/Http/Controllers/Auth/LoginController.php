<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;

class LoginController extends Controller
{
    use HasApiTokens;
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Revoke all previous tokens for making it logged our from al the other devices
            $user->tokens->each(function ($token, $key) {
                $token->delete();
            });

            $token = $user->createToken('Personal Access Token')->accessToken;

            return response()->json([
                'token' => $token,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }
    }
}
