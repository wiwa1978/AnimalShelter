<?php

namespace App\Livewire\Animals;

use App\Models\User;
use App\Models\Animal;
use Livewire\Component;
use App\Models\Organization;
use Illuminate\Support\Facades\Log;


class AnimalsByOrganization extends Component
{

    //test
    public $animals;
    public $organization;
    public $animals_count;
    public $isAnimalBelongsToAsiel;
    public $isAnimalBelongsToStichting;
    public $isAnimalBelongsToParticulier;

    public function mount(Organization $organization)
    {
       
        $this->organization = $organization;
        $this->animals = Animal::where('organization_id', $organization->id)->get();
        $this->isAnimalBelongsToAsiel = Organization::isShelter($this->organization->id)->exists();
        $this->isAnimalBelongsToStichting = Organization::isOrganization($this->organization->id)->exists();
        $this->isAnimalBelongsToParticulier = Organization::isIndividual($this->organization->id)->exists();
        $this->animals_count = $this->animals->count();
        
        Log::debug("Retrieving animals for organization {$organization->id}");
    }

    public function render()
    {
        return view('components.animals.animals-organization');
    }
}
