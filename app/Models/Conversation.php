<?php

namespace App\Models;

use App\Models\User;
use App\Models\Message;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['id', 'subject'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
        //->logOnly(['name', 'text']);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public  function getParticipants($id)
    {
        return $this->users()->get();
    }
}
