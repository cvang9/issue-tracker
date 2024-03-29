<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tickets() : HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function resolvers() : HasMany
    {
        return $this->hasMany(Resolver::class);
    }

}
