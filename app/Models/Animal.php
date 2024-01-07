<?php

namespace App\Models;

use App\Models\User;
use App\Enums\AnimalType;
use App\Enums\AnimalStatus;
use App\Enums\AnimalLocation;
use App\Enums\AnimalPublishState;
use Spatie\Activitylog\LogOptions;
use App\Models\Traits\Multitenantable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory, Multitenantable, LogsActivity;

    protected $fillable = [
        'name', 'user_id', 'slug', 'featured', 'published_state', 'published_at', 'publish_price', 'feature_price', 'animal_type', 'location', 'age', 'gender', 'status', 'size', 'description', 'breed', 'reason_adoption', 'sterilized', 'chipped', 'passport', 'vaccinated', 'rabies', 'medicins', 'special_food', 'behavioural_problem', 'kids_friendly', 'cats_friendly', 'dogs_friendly', 'environment',
        'affectionate', 'well_behaved', 'playful', 'everybody_friendly', 'environment', 'photo_main', 'photos_additional', 'videos', 'youtube_links', 'unpublish_reason', 'unpublish_at'

    ];

    protected $casts = [
        'animal_type'       =>  AnimalType::class,
        'location'          =>  AnimalLocation::class,
        'status'            =>  AnimalStatus::class,
        'publish_state'     =>  AnimalPublishState::class,
        'videos'            =>  'array',
        'photos_additional' =>  'array',
        'youtube_links'     =>  'array',
        'chipped'           =>  'boolean',
        'passport'          =>  'boolean',
        'vaccinated'        =>  'boolean',
        'rabies'            =>  'boolean',
        'medicins'          =>  'boolean',
        'special_food'      =>  'boolean',
        'behavioural_problem'   =>  'boolean',
        'affectionate'      =>  'boolean',
        'well_behaved'      =>  'boolean',
        'playful'           =>  'boolean',
        'everybody_friendly' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vouchers(): HasMany
    {
        return $this->hasMany(Voucher::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function scopeDogs($query)
    {
        return $query->where('animal_type', AnimalType::Dog);
    }

    public function scopeCats($query)
    {
        return $query->where('animal_type', AnimalType::Cat);
    }

    public function scopeOthers($query)
    {
        return $query->where('animal_type', AnimalType::Other);
    }

    public function scopeDraft($query)
    {
        return $query->where('published_state', AnimalPublishState::Draft);
    }

    public function scopePublished($query)
    {
        return $query->where('published_state', AnimalPublishState::Published);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeNotFeatured($query)
    {
        return $query->where('featured', false);
    }

    public function scopeActiveVouchers($query)
    {
        return $query->whereHas('vouchers', function ($query) {
            $query->where('status', 'active')->where('expires_at', '>', now());
        });
    }
}
