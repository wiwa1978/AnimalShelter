<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\Animal;
use App\Models\Organization;
use Illuminate\Support\Collection;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\HasTenants;
use Filament\Models\Contracts\FilamentUser;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Edwink\FilamentUserActivity\Traits\UserActivityTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use RalphJSmit\Filament\Notifications\Concerns\FilamentNotifiable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;


class User extends Authenticatable implements FilamentUser, HasTenants, MustVerifyEmail 
{
    use HasFactory;
    use Notifiable;
    use HasRoles; 
    use AuthenticationLoggable;
    use LogsActivity;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'organization_type',
        'invited',
        'invited_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'organization_type', 'password']);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }


    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'messages');
    }


   public function canAccessPanel(Panel $panel): bool
   {
    
        if ($panel->getId() === 'admin') {
            if ($this->isSuperAdmin()) {
                return true;
            }
            else {
                return false;
            }
        }

        if ($panel->getId() === 'app') {
            return true;   
        }

        return false;
   }
 
    public function getTenants(Panel $panel): Collection
    {
        return $this->organizations;
    }
    
    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class)
            ->withTimestamps();
    }

    public function organization()
    {
        return $this->organizations()->first();
    }
    
    public function favorites()
    {
        return $this->belongsToMany(Animal::class, 'favorites');
    }

 
    public function canAccessTenant(Model $tenant): bool
    {
        //eturn $this->organizations->contains($tenant);
        return $this->organizations()->whereKey($tenant)->exists();
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    public function isRegularUser(): bool
    {
        return $this->hasRole('user');
    }

    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'ticketable');
    }

    public function latestTicket()
    {
        return $this->morphOne(Ticket::class, 'ticketable')->latestOfMany();
    }

 
}
