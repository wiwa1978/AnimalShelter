<?php

namespace App\Livewire\Animals;

use App\Models\User;
use App\Models\Animal;
use App\Models\Organization;
use Livewire\Component;


class AnimalsByOrganization extends Component
{
    public $animals;
    public $organization;
    public $animals_count;
    public $isAnimalBelongsToShelter;

    public function mount(Organization $organization)
    {
       
        $this->organization = $organization;
        $this->animals = Animal::where('organization_id', $organization->id)->get();
        $this->isAnimalBelongsToShelter = Organization::isShelter($organization->id)->exists();
        $this->animals_count = $this->animals->count();
        
    }

    public function render()
    {
        return view('components.animals.animals-organization');
    }
}
