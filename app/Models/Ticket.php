<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{


    protected $guarded = [];

    public function ticketable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(config('tickets.user-model'));
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function assigned_to()
    {
        return $this->belongsTo(config('tickets.user-model'));
    }

    public function priorityColor()
    {
        $colors = [1 => 'success', 2 => 'primary', 3 => 'warning', 4 => 'danger'];

        return $colors[$this->priority] ?? 'danger';
    }
}
