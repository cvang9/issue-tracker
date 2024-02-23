<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResolverController;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'login' ] );
Route::post('/register', [AuthController::class, 'register' ] );
Route::post('/logout', [ AuthController::class, 'logout' ]);

Route::get('/{vue_capture?}', fn() => view('app') )->where('vue_capture', '[\/\w\.-]*');