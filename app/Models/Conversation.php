<?php

namespace App\Models;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'subject'];

    public function messages()
    {
        return $this->hasMany(Message::class);
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
