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

    public $searchTerm;
    public $searchAnimalType='None';
    public $searchAnimalLocation='None';
    public $searchAnimalAge='None';
    public $searchAnimalGender='None';
    public $searchAnimalOwner='None';

    public $animaltypes = ['Dog', 'Cat', 'Other'];

    public $animallocations = ['België', 'Nederland', 'Duitsland', 'Albanië'];

    public $animalages = ['1-2 jaar', '2-3 jaar', '3-4 jaar', '5-6 jaar'];

    public $animalgenders = ['Mannelijk', 'Vrouwelijk'];

    public $animalowners = ['Particulier', 'Stichting'];


    public function render()
    {
        //dd($this->animaltypes);
        //$animals = Animal::whereLike('name', $this->search ?? '')->get();
        //dd($animals);
        // return view('components.home.home1', [
        //     'animals_featured' => Animal::featured()->paginate(4),
        //     'animals_not_featured' => Animal::notFeatured()->paginate(12),
        // ]);
        
      
        // return view('components.home.home1', [
        //     'animals_featured' => Animal::featured(),
        //     'animals_not_featured' => Animal::whereLike('name', $this->searchTerm ?? '')
        //         ->when($this->animaltypes, function($query, $animaltypes) {
        //             return $query->whereIn('animal_type', $animaltypes);
        //         })
        //         ->get(),
        //     //'animals_not_featured' => Animal::search('name', $this->searchTerm ?? '')->paginate(12)
        // ]);
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
