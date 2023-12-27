<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company',
        'company_name',
        'website'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {

            return $this->isSuperAdmin();
        }

        if ($panel->getId() === 'app') {
            return !$this->isCompany() || !$this->isSuperAdmin();
        }

        if ($panel->getId() === 'app-org') {
            return $this->isCompany();
        }

        //return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
        //return true;
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('Super Admin');
    }

    public function isCompany(): bool
    {
        return $this->company == true;
    }

    public function scopeSuperAdmins($query)
    {
        return $query->whereHas('roles', function ($roleQuery) {
            $roleQuery->where('name', 'Super Admin');
        });
    }

    public function scopeRegularUsers($query)
    {
        return $query->whereDoesntHave('roles', function ($roleQuery) {
            $roleQuery->where('name', 'Super Admin');
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
