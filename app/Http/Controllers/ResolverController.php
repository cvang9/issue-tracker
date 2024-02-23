<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResolverResource;
use App\Http\Resources\ResolverResourceCollection;
use App\Models\Department;
use App\Models\Resolver;
use App\Models\Ticket;
use App\Models\User;

class ResolverController extends Controller
{


    public function index()
    {
        $resolvers = Resolver::all();
        return new ResolverResourceCollection($resolvers);
    }

    public function store()
    {
        $validated = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'department' => 'required'
        ]);

        $department = Department::where('name', '=', $validated['department'] )->first();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'resolver'
        ]);

        $resolver = Resolver::create([
            'user_id' => $user->id,
            'department_id' => $department->id
        ]);

        return response([
            'success' => 'Successfully created a resolver',
            'id' => $resolver->id
        ], 201 );
    }                                                       

    public function show($resolver_id)
    {
        $resolver = Resolver::findOrFail($resolver_id);
        return new ResolverResource($resolver);
    }

    public function update($resolver_id)
    {
        $validated = request()->validate([
            'department' => 'required'
        ]);

        $resolver = Resolver::findOrFail($resolver_id);

        $department = Department::where('name', '=', $validated['department'] )->first();

        $resolver->update([
            'department_id' => $department->id
        ]);

        return response(['Success' => 'Successfully updated resolver '], 200 );
    }

    public function destroy($resolver_id)
    {
        $resolver = Resolver::findOrFail($resolver_id);
        
        $resolver->delete();

        return response(['success' => 'Successfully deleted resolver'], 200);
    }

    public function updateTicket( $resolver_id, $ticket_id )
    {
        $validated = request()->validate([
            'feedback' => 'required',
            'status' => 'required'
        ]);

        $ticket = Ticket::findOrFail($ticket_id);

        $ticket->update([
            'feedback' => $validated['feedback'],
            'status' => $validated['status'],
            'resolver_id' => $resolver_id
        ]);

        return response(['Success' => 'Successfully updated ticket'], 200);
    }
}
