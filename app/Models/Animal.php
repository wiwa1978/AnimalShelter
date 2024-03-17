<?php

namespace App\Models;

use App\Enums\AnimalType;
use App\Enums\AnimalStatus;
use App\Enums\ApprovalState;
use App\Enums\AnimalLocation;
use App\Enums\AnimalPublishState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'organization_id','date_added', 'published','featured', 'published_at', 'unpublished_at', 'approval_state', 'published_state','unpublished_reason', 'animal_type', 'current_location', 'original_location', 'current_kids', 'current_cats', 'current_dogs', 'current_home_alone', 'current_garden', 'adoption_fee', 'age','gender','status','size','breed','reason_adoption','sterilized','chipped','passport','vaccinated','rabies','medicins','special_food','behavioural_problem','kids_friendly_6y','kids_friendly_14y','cats_friendly','dogs_friendly','well_behaved','playful','everybody_friendly','affectionate','needs_garden','needs_movement','potty_trained','car_friendly','home_alone','knows_commands','experience_required','description','environment','photo_featured','photos_additional', 'videos', 'youtube_links'
       ];

    protected $casts = [
        'animal_type'           =>  AnimalType::class,
        'location'              =>  AnimalLocation::class,
        'status'                =>  AnimalStatus::class,
        'publish_state'         =>  AnimalPublishState::class,
        'approval_state'        =>  ApprovalState::class,
        'videos'                =>  'array',
        'photos_additional'     =>  'array',
        'youtube_links'         =>  'array',
        'sterilized'            =>  'boolean',
        'chipped'               =>  'boolean',
        'passport'              =>  'boolean',
        'vaccinated'            =>  'boolean',
        'rabies'                =>  'boolean',
        'medicins'              =>  'boolean',
        'special_food'          =>  'boolean',
        'behavioural_problem'   =>  'boolean',
        'kids_friendly_6y'      =>  'boolean',
        'kids_friendly_14y'     =>  'boolean',
        'cats_friendly'         =>  'boolean',
        'dogs_friendly'         =>  'boolean',
        'well_behaved'          =>  'boolean',
        'everybody_friendly'    =>  'boolean',
        'affectionate'          =>  'boolean',
        'needs_garden'          =>  'boolean',
        'needs_movement'        =>  'boolean',
        'potty_trained'         =>  'boolean',
        'car_friendly'          =>  'boolean',
        'home_alone'            =>  'boolean',
        'knows_commands'        =>  'boolean',
        'experience_required'   =>  'boolean'
    ];
        
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
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

    public function scopeUnPublished($query)
    {
        return $query->where('published_state', AnimalPublishState::Unpublished);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeNotFeatured($query)
    {
        return $query->where('featured', false);
    }

    public function scopeBelongsToShelter($query)
    {
        return $query->whereHas('organization', function ($query) {
            $query->where('is_shelter', 1);
        });
    }

}
