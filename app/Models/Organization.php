<?php

namespace App\Models;

use Spark\Spark;
use Spark\Billable;
use App\Models\User;
use App\Models\Animal;
use Illuminate\Support\Str;
use App\Enums\OrganizationType;
use App\Enums\OrganizationTypes;
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
        'organization_type',
        'organization_name',
        'organization_website',
        'email',
        'phone',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_state',
        'billing_postal_code',
        'vat_id',
        'invoice_emails',
        'billing_country',
        'invoice_emails',

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
    
    public function getPlan()
    {
        $plan = $this->sparkPlan();

        if ($plan !== null) {
            return $plan;
        }

        // Fallback to "Individual" plan
        $plan = Spark::plans('organization')->firstWhere('name', '=', 'fallback');
        
        return $plan;
    }
    
    public function isBillable(): bool
    {
        return ! $this->free_forever;
    }

    
    public function isFreeForever(): bool
    {
        return $this->free_forever;
    }

    public function isOnTrialOrSubscribed(): bool
    {
        return $this->onTrial() || $this->subscribed();
    }

    public function organizationIsShelter(): bool
    {
        return $this->organization_type == OrganizationType::SHELTER->name;
    }

    public function organizationIsNotShelter(): bool
    {
        dd($this->organization_type != OrganizationType::SHELTER->name);
        return $this->organization_type != OrganizationType::SHELTER->name;
    }

    public function organizationIsIndividual(): bool
    {
        return $this->organization_type == OrganizationType::INDIVIDUAL->name;
    }

    public function organizationIsOrganization(): bool
    {
        return $this->organization_type == OrganizationType::ORGANIZATION->name;
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

    public function scopeIsIndividual($query, $organizationId)
    {
        //dd(OrganizationType::INDIVIDUAL->name);
        return $query->where('id', $organizationId)->where('organization_type', OrganizationType::INDIVIDUAL->value);
    }

    public function scopeIsShelter($query, $organizationId)
    {
        return $query->where('id', $organizationId)->where('organization_type', OrganizationType::SHELTER->value);
    }

    public function scopeIsOrganization($query, $organizationId)
    {
        return $query->where('id', $organizationId)->where('organization_type', OrganizationType::ORGANIZATION->value);
    }
}
