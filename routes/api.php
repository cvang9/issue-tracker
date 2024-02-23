<?php

use App\Http\Controllers\ResolverController;
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

    // UserController
    Route::get('/users', [UserController::class, 'index' ] )->name('users.index');
    Route::get('/users/{user_id}', [UserController::class, 'show' ] )->name('users.show');

    // TicketController
    Route::get('/tickets', [TicketController::class, 'index' ] )->name('tickets.index');
    Route::get('/tickets/{ticket_id}', [TicketController::class, 'show' ] )->name('tickets.show');
    Route::get('/users/{user_id}/tickets', [TicketController::class, 'getAllUserTickets' ] )->name('tickets.users.index');
    Route::post('/users/{user_id}/tickets', [TicketController::class, 'store'] )->name('tickets.store');
    Route::put('/users/{user_id}/tickets/{ticket_id}', [TicketController::class, 'update'])->middleware(['can:isUser'])->name('tickets.update');
    Route::delete('/users/{user_id}/tickets/{ticket_id}', [TicketController::class, 'destroy'] )->middleware(['can:isUser'])->name('tickets.destroy');

    // ResolverController
    Route::get('/resolvers', [ResolverController::class, 'index'] )->name('resolvers.index');
    Route::get('/resolvers/{resolver_id}', [ResolverController::class, 'show'] )->name('resolvers.show');
    // Route::get('/resolvers/{resolver_id}/tickets', [ResolverController::class, 'getResolverTickets'] )->name('resolvers.tickets');
    Route::put('/resolvers/{resolver_id}/tickets/{ticket_id}', [ResolverController::class, 'updateTicket'] )->name('resolvers.status.update');
    Route::post('/resolvers', [ResolverController::class, 'store'] )->middleware(['can:isAdmin'])->name('resolvers.store');
    Route::put('/resolvers/{resolver_id}', [ResolverController::class, 'update'] )->middleware(['can:isAdmin'])->name('resolvers.update');
    Route::delete('/resolvers/{resolver_id}', [ResolverController::class, 'destroy'] )->middleware(['can:isAdmin'])->name('resolvers.destroy');

});
