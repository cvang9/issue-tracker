<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResolverResourceCollection;
use App\Http\Resources\UserResource;
use App\Models\Department;
use App\Models\Resolver;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    
    public function fetchData()
    {

        $pending_tickets = Ticket::where('status', '=', 'pending' )->count();
        $resolved_tickets = Ticket::where('status', '=', 'resolved' )->count();
        $rejected_tickets = Ticket::where('status', '=', 'rejected' )->count();
        $procesing_tickets = Ticket::where('status', '=', 'processing' )->count();

        $users_count = User::all()->count();

        $resolver_count = Resolver::all()->count();

        $department_count = Department::all()->count();

        $clean_users_count = User::where('role', '=', 'user' )->count();


        $currentYear = now()->year;

        if(cache()->has('all_tickets_by_month')) {

            $ticketsByMonth = cache()->get('all_tickets_by_month', null);
        }
        else {

            
            $ticketsByMonth = Ticket::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as ticket_count'))
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->keyBy('month') 
            ->map(fn ($item) => ['ticket_count' => $item->ticket_count])
            ->toArray();
            
        }


        if( cache()->has('resolved_tickets_by_month') )
        {
            $resolvedTicketsByMonth = cache()->get('resolved_tickets_by_month', null);
        }
        else {

            $resolvedTicketsByMonth = Ticket::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as ticket_count'))
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->where('status', '=', 'resolved')
            ->get()
            ->keyBy('month') 
            ->map(fn ($item) => ['ticket_count' => $item->ticket_count])
            ->toArray();
            
        }


        $startOfWeek = now()->startOfWeek()->format('Y-m-d H:i:s');
        $endOfWeek = now()->endOfWeek()->format('Y-m-d H:i:s');

        if( cache()->has('tickets_by_day') ) 
        {
            $ticketsByDay = cache()->get('tickets_by_day', null);
        }
        else {

            $ticketsByDay = Ticket::select(
                DB::raw('DAYNAME(created_at) as day_of_week'), 
                DB::raw('COUNT(*) as ticket_count')
                )
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->groupBy(DB::raw('DAYNAME(created_at)'))
                ->orderBy(DB::raw('MIN(created_at)')) 
                ->get()
                ->keyBy('day_of_week') 
                ->map(fn ($item) => ['ticket_count' => $item->ticket_count])
                ->toArray();
            }
        
        if( cache()->has('resolved_tickets_by_day') )
        {
            $resolvedTicketsByDay = cache()->get('resolved_tickets_by_day', null);
        }
        else {

            $resolvedTicketsByDay = Ticket::select(
                DB::raw('DAYNAME(created_at) as day_of_week'), 
                DB::raw('COUNT(*) as ticket_count')
                )
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->groupBy(DB::raw('DAYNAME(created_at)'))
                ->orderBy(DB::raw('MIN(created_at)')) 
                ->where('status', '=', 'resolved')
                ->get()
                ->keyBy('day_of_week') 
                ->map(fn ($item) => ['ticket_count' => $item->ticket_count])
                ->toArray();
                
            }

        return response([
            'data' => [
                'type' => 'admin stats',
                'attributes' => [
                    'count' => [
                        'tickets' => [
                            'pending' => $pending_tickets,
                            'resolved' => $resolved_tickets,
                            'rejected' => $rejected_tickets,
                            'processing' => $procesing_tickets
                        ],
                        'users' => [
                            'all_user' => $users_count,
                            'resolver' => $resolver_count,
                            'department' => $department_count,
                            'clean_user' => $clean_users_count,
                            'admin' => 1
                        ]
                    ],
                    'stats' => [
                        'yearly' => [
                            'created' => $ticketsByMonth,
                            'resolved' => $resolvedTicketsByMonth
                        ],
                        'weekly' => [
                            'created' => $ticketsByDay,
                            'resolved' => $resolvedTicketsByDay
                        ]
                    ]
                ]
            ]
        ], 200);
    }

    public function fetchResolvers()
    {

        $resolvers = Resolver::all();

        return new AdminResolverResourceCollection( $resolvers );
    }

    public function show()
    {
        $admin = User::where('role', '=', 'admin' )->first();

        return new UserResource($admin);
    }
}
