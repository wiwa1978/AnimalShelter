<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Message extends Model
{
    use HasFactory;
    use LogsActivity;

    //public $table = 'messages';
    protected $fillable = ['id', 'organization_id', 'conversation_id', 'sender_email', 'receiver_email', 'animal_id', 'content', 'read_by'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
        //->logOnly(['name', 'text']);
    }
   
    public function conversation(): BelongsTo {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getTimeAttribute(): string {
        return date(
            "d M Y, H:i:s",
            strtotime($this->attributes['created_at'])
        );
    }
}