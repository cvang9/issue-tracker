<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminNotificationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ResolverController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



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
    Route::get('/resolvers/{resolver_id}/tickets/', [ResolverController::class, 'departmentTicket'] )->name('resolvers.status.update');
    Route::put('/resolvers/{resolver_id}/tickets/{ticket_id}', [ResolverController::class, 'updateTicket'] )->name('resolvers.status.update');
    Route::post('/resolvers', [ResolverController::class, 'store'] )->middleware(['can:isAdmin'])->name('resolvers.store');
    Route::put('/resolvers/{resolver_id}', [ResolverController::class, 'update'] )->middleware(['can:isAdmin'])->name('resolvers.update');
    Route::delete('/resolvers/{resolver_id}', [ResolverController::class, 'destroy'] )->middleware(['can:isAdmin'])->name('resolvers.destroy');

    // DepartmentController
    Route::get('/departments', [DepartmentController::class, 'index' ] )->name('departments.index');
    Route::get('/departments/{department_id}', [DepartmentController::class, 'show' ] )->name('departments.show');
    Route::post('/departments', [DepartmentController::class, 'store'] )->middleware(['can:isAdmin'])->name('departments.store');
    Route::put('/departments', [DepartmentController::class, 'update'] )->middleware(['can:isAdmin'])->name('departments.update');
    Route::put('/departments/delete', [DepartmentController::class, 'destroy'] )->middleware(['can:isAdmin'])->name('departments.destroy');


    // Admin Controller
    Route::get('/admin/data', [AdminController::class, 'fetchData' ] )->middleware(['can:isAdmin'])->name('admin.data');
    Route::get('/admin/resolvers', [AdminController::class, 'fetchResolvers' ] )->middleware(['can:isAdmin'])->name('admin.data');
    Route::get('/admin', [AdminController::class, 'show'] )->middleware(['can:isAdmin'])->name('admin.show');
    

    // AdminNotification Controller
    Route::get('/admin/notifications', [AdminNotificationController::class, 'getLatestNotifications'] )->name('admin.notifications');

    //ChatController
    Route::get('/messages/{hash}', [ChatController::class, 'index'] )->name('chats.index');
    Route::post('/messages', [ChatController::class, 'store'] )->name('chats.store');
    Route::post('/messages/{resolver_id}/notify/{user_id}', [ ChatController::class, 'notifyUser'] )->name('chats.notify');
});
