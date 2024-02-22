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
            return response(['success' => 'You are authenticated'], 200 );
        }

        return response(['error' => 'Invalid credentials'], 201 );
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        auth()->login($user);

        return response(['success' => 'User registered'], 200 );
    }

    public function logout()
    {
        auth()->logout();

        return response(['success' => 'logged out'], 200 );
    }
}
