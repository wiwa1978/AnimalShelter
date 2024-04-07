<?php

namespace App\Livewire\Animals;

use App\Models\Animal;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\ShowAnimalDetail;
use Illuminate\Support\Facades\Route;

class Animals extends Component
{
    use WithPagination;

    public $animal;
    public $currentRoute;
    const PER_PAGE = 12;

   
    public function mount()
    {
        $this->currentRoute = Route::currentRouteName();
    }

    public function render()
    {
        
        if ($this->currentRoute == 'show-dogs') {
       
            return view('components.animals.animals',  [
                'animals_all' => Animal::dogs()->paginate(self::PER_PAGE),
                'animal_type' => "dog",
                'animals_count' => Animal::dogs()->count(),
                
            ]);
        }

        if ($this->currentRoute == 'show-featured-dogs') {
            return view('components.animals.animals',  [
                'animals_all' => Animal::dogs()->featured()->paginate(self::PER_PAGE),
                'animal_type' => "dog-featured",
                'animals_count' => Animal::dogs()->featured()->count(),
            ]);
        }

        if ($this->currentRoute == 'show-cats') {
            return view('components.animals.animals',  [
                'animals_all' => Animal::cats()->paginate(self::PER_PAGE),
                'animal_type' => "cat",
                'animals_count' => Animal::cats()->count(),
            ]);
        }

        if ($this->currentRoute == 'show-featured-cats') {
            return view('components.animals.animals',  [
                'animals_all' => Animal::cats()->featured()->paginate(self::PER_PAGE),
                'animal_type' => "cat-featured",
                'animals_count' => Animal::cats()->featured()->count(),
            ]);
        }

        if ($this->currentRoute == 'show-others') {
            return view('components.animals.animals',  [
                'animals_all' => Animal::others()->paginate(self::PER_PAGE),
                'animal_type' => "other",
                'animals_count' => Animal::others()->count(),
            ]);
        }

        if ($this->currentRoute == 'show-featured-others') {
            return view('components.animals.animals',  [
                'animals_all' => Animal::others()->featured()->paginate(self::PER_PAGE),
                'animal_type' => "other-featured",
                'animals_count' => Animal::others()->featured()->count(),
            ]);
        }


    }

    public function showAnimalDetail($id)
    {
        $animal = Animal::find($id);
        $this->animal = $animal;

        $this->redirect(route('show-animal-detail', ['id' => $animal->id]));
    }
}
