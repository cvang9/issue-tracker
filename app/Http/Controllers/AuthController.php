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

            $user = auth()->user();
            $token = $user->createToken('my-key')->plainTextToken;

            if( $user->role == 'user' ) {
                return response([
                    'token' => $token,
                    'id' => $user->id
                ], 200);
            } 

            else if( $user->role == 'resolver' ) {
                return response([
                    'token' => $token,
                    'id' => $user->resolver->id
                ], 200);
            }

            else {
                return response([
                    'token' => $token
                ], 200);
            }

        }

        return response(['error' => 'Invalid credentials'], 501 );
    }

    public function register()
    {

        $validated = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'file' => 'required|file'
        ]);

        $file = request()->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('uploads', $fileName); 

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'user',
            'img' => $fileName
        ]);


        auth()->login($user);

        $token = auth()->user()->createToken('my-key')->plainTextToken;

        return response([
            'token' => $token,
            'id' => $user->id
        ], 200);
    }

    public function logout()
    {
        auth()->logout();

        return response(['success' => 'logged out'], 200 );
    }
}
