<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketResourceCollection;
use App\Jobs\SendTicketCreatedNotification;
use App\Models\Department;
use App\Models\Resolver;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TestNotification;
use App\Notifications\TicketCreatedNotification;
use Illuminate\Http\Request;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();

        return new TicketResourceCollection($tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( $user_id )
    {
        $validate = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'department' => 'required'
        ]);

        $department = Department::where('name', '=', $validate['department'])->first();

        $ticket = Ticket::create([
            'title' => $validate['title'],
            'body' => $validate['body'],
            'status' => 'pending',
            'user_id' => $user_id,
            'department_id' => $department->id
        ]);

        // Send Notifications To All Resolvers that are from same department
        $resolvers = Resolver::where('department_id', '=', $department->id )->get();

        foreach ($resolvers as $resolver) {
            SendTicketCreatedNotification::dispatch($resolver->user, $ticket);
        }


        

        return response([
            'data' => [
                'success' => 'Successfully created a ticket'
            ]
        ], 201 );

    }

    /**
     * Display the specified resource.
     */
    public function show($ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);

        return new TicketResource($ticket);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($user_id, $ticket_id)
    {
        $validated = request()->validate([
            'body' => '',
            'department' => '',
        ]);

        $ticket = Ticket::findOrFail($ticket_id);
        $department = Department::where('name', '=', $validated['department'])->first();
        
        $ticket->update([
            'body' => $validated['body'],
            'department_id' => $department->id
        ]);

        return response([
            'data' => [
                'success' => 'Successfully updated a ticket'
            ]
        ], 201 );         
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id, $ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);

        $ticket->delete();

        return response([
            'data' => [
                'success' => 'Successfully deleted a ticket'
            ]
        ], 201 );
    }

    public function getAllUserTickets( $user_id )
    {
        $user = User::findOrFail($user_id);

        return new TicketResourceCollection( $user->tickets );
    }
}
