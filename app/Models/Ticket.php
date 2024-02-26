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

    protected static function booted()
    {

        // Update Event
        static::updated( fn() => cache()->forget('all_tickets_by_month') );
        static::updated( fn() => cache()->forget('resolved_tickets_by_month') );
        static::updated( fn() => cache()->forget('tickets_by_day') );
        static::updated( fn() => cache()->forget('resolved_tickets_by_day') );

        //Delete Event
        static::deleted( fn() => cache()->forget('all_tickets_by_month') );
        static::deleted( fn() => cache()->forget('resolved_tickets_by_month') );
        static::deleted( fn() => cache()->forget('tickets_by_day') );
        static::deleted( fn() => cache()->forget('resolved_tickets_by_day') );

        // Create Event
        static::created( fn() => cache()->forget('all_tickets_by_month') );
        static::created( fn() => cache()->forget('resolved_tickets_by_month') );
        static::created( fn() => cache()->forget('tickets_by_day') );
        static::created( fn() => cache()->forget('resolved_tickets_by_day') );
    }
}
