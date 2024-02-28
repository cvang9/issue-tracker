<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdminNotifications extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ticket() : HasOne
    {
        return $this->hasOne(Ticket::class);
    }
}
