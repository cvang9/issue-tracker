<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department() : BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function resolver() : BelongsTo 
    {
        return $this->belongsTo(Resolver::class);
    }
    

    protected static function booted()
    {

        // Update Event

        static::updated( function(Ticket $ticket) {

            cache()->forget('all_tickets_by_month');
            cache()->forget('resolved_tickets_by_month');
            cache()->forget('tickets_by_day');
            cache()->forget('resolved_tickets_by_day');

            $resolver = Resolver::findOrFail($ticket->resolver_id);

            AdminNotifications::create([
                'operation' => 'updated',
                'name' => $ticket->user->name,
                'ticket_id' => $ticket->id,
                'resolver_name' => $resolver->user->name
            ]);

        });

        

        static::created( function(Ticket $ticket) {

            cache()->forget('all_tickets_by_month');
            cache()->forget('resolved_tickets_by_month');
            cache()->forget('tickets_by_day');
            cache()->forget('resolved_tickets_by_day');

            AdminNotifications::create([
                'operation' => 'created',
                'name' => $ticket->user->name,
                'ticket_id' => $ticket->id
            ]);

        });

        

        static::deleted( function(Ticket $ticket) {

            cache()->forget('all_tickets_by_month');
            cache()->forget('resolved_tickets_by_month');
            cache()->forget('tickets_by_day');
            cache()->forget('resolved_tickets_by_day');

        });

        
    }
}
