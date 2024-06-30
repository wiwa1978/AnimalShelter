<?php

namespace App\Livewire\Animals;

use App\Enums\AnimalAge;
use App\Enums\AnimalLocation;
use App\Models\Animal;
use Livewire\Component;
use App\Enums\AnimalType;
use App\Enums\AnimalGender;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use App\Enums\OrganizationType;
use Illuminate\Database\Eloquent\Builder;

#[Title('AnimalShelter - Home')]
class SearchAnimal extends Component
{
    use WithPagination;
    
    public $animals_count;

    public $animals;

    public $searchTerm;
    public $searchAnimalType='None';
    public $searchAnimalLocation='None';
    public $searchAnimalAge='None';
    public $searchAnimalGender='None';
    public $searchAnimalOwner='None';

    public $animaltypes;

    public $animallocations;

    public $animalages;

    public $animalgenders;


    public $animalowners;

    public function mount(): void
    {   
        $this->animaltypes = AnimalType::options();
        $this->animallocations = AnimalLocation::options();
        $this->animalages =  AnimalAge::options();
        $this->animalgenders =  AnimalGender::options();
        $this->animalowners = OrganizationType::options();
        
    }

    public function updating($key): void
    {
        
        if ($key === 'searchTerm' || $key === 'searchAnimalType' || $key === 'searchAnimalLocation' || $key === 'searchAnimalAge' || $key === 'searchAnimalGender' || $key === 'searchAnimalOwner') {
            $this->resetPage();
        }
    }


    public function searchFunction(): void
    {

        $this->animals = 
        
        Animal::when($this->searchTerm !== '', fn(Builder $query) => $query->where('name', 'like', '%'. $this->searchTerm .'%')) 
            ->when($this->searchAnimalType !== 'None', function(Builder $query) {
                $animalType = $this->searchAnimalType === __('animals_back.dog') ? 'Dog' : ($this->searchAnimalType=== __('animals_back.cat') ? 'Cat' : 'Other');
                $query->where('animal_type', 'like', $animalType);
            })

            ->when($this->searchAnimalLocation !== 'None', function(Builder $query) {
                $currentLocation = $this->searchAnimalLocation === __('animals_back.albania') ? 'Albania' : ($this->searchAnimalLocation=== __('animals_back.netherlands') ? 'Netherlands' : ($this->searchAnimalLocation===__('animals_back.germany') ? 'Germany' : 'Belgium'));
                $query->where('current_location', 'like', $currentLocation);
            })

            ->when($this->searchAnimalAge !== 'None', fn(Builder $query) => $query->where('age', 'like', $this->searchAnimalAge))           
            
            ->when($this->searchAnimalGender !== 'None', function(Builder $query) {
                $animalGender = $this->searchAnimalGender === __('animals_back.male') ? 'Male' : 'Female';
                $query->where('gender', 'like', $animalGender);
            })
            
            ->when($this->searchAnimalOwner !== 'None', function ($query) {
                $organizationType = $this->searchAnimalOwner === __('animals_back.shelter') ? 'Shelter' : ($this->searchAnimalOwner=== __('animals_back.organization') ? 'Organization' : 'Individual');

                $query->whereHas('organization', function ($query) use ($organizationType) {
                    $query->where('organization_type', 'like', $organizationType);
                });
            })
            
            ->published()
            ->get();
           
        $this->animals_count = $this->animals->count();
  
        //dd($this->animals_count);

    }
    public function hydrate(): void
    {
        $this->searchFunction();  
    }

    public function resetFilter()
    {
        $this->searchTerm = '';
        $this->searchAnimalType = 'None';
        $this->searchAnimalLocation = 'None';
        $this->searchAnimalAge = 'None';
        $this->searchAnimalGender = 'None';
        $this->searchAnimalOwner = 'None';
    }

    public function render()
    {  
        $this->searchFunction();

        return view('components.animals.search-animal', [
            'animals_all' => $this->animals,
            'animals_count' => $this->animals_count
        ]);

    }
}
