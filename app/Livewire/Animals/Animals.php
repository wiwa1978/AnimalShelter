<?php

namespace App\Livewire\Animals;

use App\Models\Animal;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\ShowAnimalDetail;
use Illuminate\Support\Facades\Log;
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
                'animals_all' => Animal::dogs()->published()->paginate(self::PER_PAGE),
                'animal_type' => "dog",
                'animals_count' => Animal::dogs()->published()->count(),
                
            ]);
        }

        if ($this->currentRoute == 'show-featured-dogs') {
            return view('components.animals.animals',  [
                'animals_all' => Animal::dogs()->published()->featured()->paginate(self::PER_PAGE),
                'animal_type' => "dog-featured",
                'animals_count' => Animal::dogs()->published()->featured()->count(),
            ]);
        }

        if ($this->currentRoute == 'show-cats') {
            return view('components.animals.animals',  [
                'animals_all' => Animal::cats()->published()->paginate(self::PER_PAGE),
                'animal_type' => "cat",
                'animals_count' => Animal::cats()->published()->count(),
            ]);
        }

        if ($this->currentRoute == 'show-featured-cats') {
            return view('components.animals.animals',  [
                'animals_all' => Animal::cats()->published()->featured()->paginate(self::PER_PAGE),
                'animal_type' => "cat-featured",
                'animals_count' => Animal::cats()->published()->featured()->count(),
            ]);
        }

        if ($this->currentRoute == 'show-others') {
            return view('components.animals.animals',  [
                'animals_all' => Animal::others()->published()->paginate(self::PER_PAGE),
                'animal_type' => "other",
                'animals_count' => Animal::others()->published()->count(),
            ]);
        }

        if ($this->currentRoute == 'show-featured-others') {
            return view('components.animals.animals',  [
                'animals_all' => Animal::others()->published()->featured()->paginate(self::PER_PAGE),
                'animal_type' => "other-featured",
                'animals_count' => Animal::others()->published()->featured()->count(),
            ]);
        }




    }

    // public function showAnimalDetail($id)
    // {
    //    dd('test');
    //     $animal = Animal::find($id);

    //     $this->animal = $animal;

    //      Log::debug("Retrieving details from organization {$animal->organization->id} for animal {$animal->id}");

    //     $this->redirect(route('show-animal-detail', ['id' => $animal->id]));
    // }
}
