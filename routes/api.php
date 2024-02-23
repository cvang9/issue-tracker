<?php

use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->group( function() {

    Route::get('/users', [UserController::class, 'index' ] )->name('users.index');
    Route::get('/users/{user_id}', [UserController::class, 'show' ] )->name('users.show');

    Route::get('/tickets', [TicketController::class, 'index' ] )->name('tickets.index');
    Route::get('/tickets/{ticket_id}', [TicketController::class, 'show' ] )->name('tickets.show');
    Route::get('/users/{user_id}/tickets', [TicketController::class, 'getAllUserTickets' ] )->name('tickets.users.index');
    Route::post('/users/{user_id}/tickets', [TicketController::class, 'store'] )->name('tickets.store');
    Route::put('/users/{user_id}/tickets/{ticket_id}', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/users/{user_id}/tickets/{ticket_id}', [TicketController::class, 'destroy'] )->name('tickets.destroy');

});
