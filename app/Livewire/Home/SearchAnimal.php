<?php

namespace App\Livewire\Home;

use App\Models\Animal;
use Livewire\Component;
use App\Enums\AnimalType;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
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

    public $animaltypes = ['Hond', 'Kat', 'Ander huisdier'];

    public $animallocations = ['België', 'Nederland', 'Duitsland', 'Albanië'];

    public $animalages = ['1-2 jaar', '2-3 jaar', '3-4 jaar', '5-6 jaar'];

    public $animalgenders = ['Mannelijk', 'Vrouwelijk'];

    public $animalowners = ['Particulier', 'Asiel'];


    public function updating($key): void
    {
        if ($key === 'searchTerm' || $key === 'searchAnimalType' || $key === 'searchAnimalLocation' || $key === 'searchAnimalAge' || $key === 'searchAnimalGender' || $key === 'searchAnimalOwner') {
            $this->resetPage();
        }
    }


    public function searchFunction(): void
    {
        $this->animals = Animal::when($this->searchTerm !== '', fn(Builder $query) => $query->where('name', 'like', '%'. $this->searchTerm .'%')) 
            ->when($this->searchAnimalType !== 'None', fn(Builder $query) => $query->where('animal_type', 'like', $this->searchAnimalType)) 
            ->when($this->searchAnimalLocation !== 'None', fn(Builder $query) => $query->where('current_location', 'like', $this->searchAnimalLocation)) 
            ->when($this->searchAnimalAge !== 'None', fn(Builder $query) => $query->where('age', 'like', $this->searchAnimalAge)) 
            ->when($this->searchAnimalGender !== 'None', fn(Builder $query) => $query->where('gender', 'like', $this->searchAnimalGender)) 
            //->when($this->searchAnimalOwner !== 'None', fn(Builder $query) => $query->where('is_shelter', 1 )) 
            ->when($this->searchAnimalOwner !== 'None', function ($query) {
                $isShelter = $this->searchAnimalOwner === 'Asiel' ? 1 : 0;
                
                $query->whereHas('organization', function ($query) use ($isShelter) {
                    $query->where('is_shelter', $isShelter);
                });
            })
            ->published()
            ->get();

        $this->animals_count = $this->animals->count();

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

        return view('components.home.search-animal', [
            'animals_all' => $this->animals,
            'animals_count' => $this->animals_count
        ]);

    }
}
