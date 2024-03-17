<?php

namespace App\Models;

use App\Models\User;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Traits\HasRoles;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_shelter',
        'shelter_name',
        'shelter_website',
        'streetname',
        'streetnumber',
        'zipcode',
        'city',
        'country',
        'phonenumber',
        'email',
    ];


    public function getCurrentTenantLabel(): string
    {
        return 'Active Organization';
    }

    public function getFilamentName(): string
    {
        return "{$this->name} (DEFAULT)";
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
    public function scopeIsShelter($query, $organizationId)
    {
        return $query->where('id', $organizationId)->where('is_shelter', true);
    }
}
