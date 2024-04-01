<?php

namespace App\Models;

use Spark\Billable;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organization extends Model
{
    use HasFactory, Billable;

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

    protected $casts = [
        'trial_ends_at' => 'datetime',
    ];

    public function stripeEmail(): string|null
    {
        return $this->email;
    }
    protected static function boot()
    {
        parent::boot();

        // Listen for the creating event and set the slug before saving
        static::creating(function (Organization $organisation) {
            $organisation->slug = Str::slug($organisation->name);
        });
    }
    

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
