<?php

use App\Http\Controllers\AuthController;
// use App\Http\Controllers\ChatController;
// use App\Http\Controllers\ResolverController;
use Illuminate\Support\Facades\Route;

// Route::post('/resolvers/{resolver_id}/tickets/{ticket_id}', [ResolverController::class, 'updateTicket'] )->name('tickets.store');
// Route::get('/admin/nots', [AdminNotificationController::class, 'getLatestNotifications'] )->name('admin.notifications');
// Route::get('/resolvers/{resolver_id}', [ResolverController::class, 'departmentTicket'] );
// Route::get('1/messages/2', [ChatController::class, 'index'] )->name('chats.index');

Route::post('/login', [AuthController::class, 'login' ] );
Route::post('/register', [AuthController::class, 'register' ] );
Route::get('/logout', [ AuthController::class, 'logout' ])->middleware('auth:sanctum');

Route::get('/{vue_capture?}', fn() => view('app') )->where('vue_capture', '[\/\w\.-]*');