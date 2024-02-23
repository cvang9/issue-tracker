<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return new UserResourceCollection($users);
    }

    /**
     * Display the specified resource.
     */
    public function show( $user_id)
    {
        $user = User::findOrFail($user_id);

        return new UserResource($user);
    }

}
