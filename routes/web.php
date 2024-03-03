<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', [AdminController::class, 'show' ]);

Route::post('/login', [AuthController::class, 'login' ] );
Route::post('/register', [AuthController::class, 'register' ] );
Route::get('/logout', [ AuthController::class, 'logout' ])->middleware('auth:sanctum');

Route::get('/{vue_capture?}', fn() => view('app') )->where('vue_capture', '[\/\w\.-]*');