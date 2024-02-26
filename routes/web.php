<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResolverController;
// use App\Http\Controllers\DepartmentController;
// use App\Http\Controllers\ResolverController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;


Route::post('/resolvers/{resolver_id}/tickets/{ticket_id}', [ResolverController::class, 'updateTicket'] );
// Route::post('/mail/{user_id}', [TicketController::class, 'store'] )->name('tickets.store');
// Route::get('/admin/data', [AdminController::class, 'fetchData' ] )->name('admin.data');
// Route::get('/departments', [DepartmentController::class, 'index' ] )->name('departments.index');
// Route::get('/resolvers', [ResolverController::class, 'index'] )->name('resolvers.index');
// Route::get('/admin/resolvers', [AdminController::class, 'fetchResolvers']);

Route::post('/login', [AuthController::class, 'login' ] );
Route::post('/register', [AuthController::class, 'register' ] );
Route::get('/logout', [ AuthController::class, 'logout' ])->middleware('auth:sanctum');

Route::get('/{vue_capture?}', fn() => view('app') )->where('vue_capture', '[\/\w\.-]*');