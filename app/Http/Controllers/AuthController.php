<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use Illuminate\Http\Request;


final class AuthController extends Controller
{

    public function user()
    {
        return response()->json(auth()->user(), 200);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json('Unauthorized', 401);
        }

        $token = auth()->user()->createToken('My Token')->accessToken;

        return response()->json([
            'user' => auth()->user(),
            'access_token' => $token
        ]);
    }


    public function register(RegisterRequest $request)
    {
        $user = new User($request->validated());
        $user->save();

        return response()->json($user, 201);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json("Logged out", 200);
    }
}
