<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    //public $table = 'messages';
    protected $fillable = ['id', 'organization_id', 'conversation_id', 'sender_id', 'receiver_id', 'content', 'read_by'];


    public function sender(): BelongsTo {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver(): BelongsTo {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function organization(): BelongsTo {
        return $this->belongsTo(Organization::class);
    }

    public function conversation(): BelongsTo {
        return $this->belongsTo(Conversation::class);
    }



    public function getTimeAttribute(): string {
        return date(
            "d M Y, H:i:s",
            strtotime($this->attributes['created_at'])
        );
    }
}