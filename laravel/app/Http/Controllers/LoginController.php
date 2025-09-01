<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'Email ou mot de passe incorrect.'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'Erreur lors de la création du token.'], 500);
        }

        $user = JWTAuth::user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }
}
