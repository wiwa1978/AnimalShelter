<?php

namespace App\Livewire\Home;

use App\Models\Animal;
use Livewire\Component;
use App\Enums\AnimalType;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Database\Eloquent\Builder;

#[Title('AnimalShelter - Home')]
class Home1 extends Component
{
    use WithPagination;

    public $animals_count;
    public $searchTerm;
    public $searchAnimalType='None';
    public $searchAnimalLocation='None';
    public $searchAnimalAge='None';
    public $searchAnimalGender='None';
    public $searchAnimalOwner='None';

    public $animaltypes = ['Hond', 'Kat', 'Andere'];

    public $animallocations = ['België', 'Nederland', 'Duitsland', 'Albanië'];

    public $animalages = ['1-2 jaar', '2-3 jaar', '3-4 jaar', '5-6 jaar'];

    public $animalgenders = ['Mannelijk', 'Vrouwelijk'];

    public $animalowners = ['Particulier', 'Stichting'];


    // public function updating($key): void
    // {
    //     if ($key === 'searchTerm' || $key === 'searchAnimalType' || $key === 'searchAnimalLocation' || $key === 'searchAnimalAge' || $key === 'searchAnimalGender' || $key === 'searchAnimalOwner') {
    //         $this->resetPage();
    //     }
    // }

    public function mount()
    {
        $this->searchTerm = '';
        $this->searchAnimalType = 'None';
        $this->searchAnimalLocation = 'None';
        $this->searchAnimalAge = 'None';
        $this->searchAnimalGender = 'None';
        $this->searchAnimalOwner = 'None';

        $this->animals_count = Animal::all()->count();
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

        $animals_count = Animal::all()->count();

        $animals = Animal::notFeatured()
        ->when($this->searchTerm !== '', fn(Builder $query) => $query->where('name', 'like', '%'. $this->searchTerm .'%')) 
        ->when($this->searchAnimalType !== 'None', fn(Builder $query) => $query->where('animal_type', 'like', $this->searchAnimalType)) 
        ->when($this->searchAnimalLocation !== 'None', fn(Builder $query) => $query->where('location', 'like', $this->searchAnimalLocation)) 
        ->when($this->searchAnimalAge !== 'None', fn(Builder $query) => $query->where('age', 'like', $this->searchAnimalAge)) 
        ->when($this->searchAnimalGender !== 'None', fn(Builder $query) => $query->where('gender', 'like', $this->searchAnimalGender)) 
        ->when($this->searchAnimalOwner !== 'None', fn(Builder $query) => $query->where('gender', 'like', $this->searchAnimalOwner)) 
        ->paginate(12);

        return view('components.home.home1', [
            'animals_featured' => Animal::featured(),
            'animals_not_featured' => $animals,
            'animals_count' => $animals_count
        ]);

    }
}
