<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory;
    Use LogsActivity;

    protected $fillable = [
        'user_id', 'animal_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
        //->logOnly(['name', 'text']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

}
