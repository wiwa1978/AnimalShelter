<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInvitation extends Model
{
    protected $fillable = ['email', 'organization_type', 'organization_id', 'invited_by'];
}
