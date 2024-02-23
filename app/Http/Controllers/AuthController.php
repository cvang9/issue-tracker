<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    
    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->validated())) {
            $token = auth()->user()->createToken('my-key')->plainTextToken;

            return response([
                'token' => $token
            ], 200);
        }

        return response(['error' => 'Invalid credentials'], 501 );
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        auth()->login($user);

        $token = auth()->user()->createToken('my-key')->plainTextToken;

        return response([
            'token' => $token
        ], 200);
    }

    public function logout()
    {
        auth()->logout();

        return response(['success' => 'logged out'], 200 );
    }
}
