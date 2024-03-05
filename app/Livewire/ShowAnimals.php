<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\ShowAnimalDetail;
use Illuminate\Support\Facades\Route;

class ShowAnimals extends Component
{
    use WithPagination;

    public $animal;
    public $animals_featured;
    public $animals_not_featured;
    public $currentRoute;
    public $animal_type;

    public function mount()
    {
        $this->currentRoute = Route::currentRouteName();

        if ($this->currentRoute == 'show-dogs') {
            $this->animals_featured = Animal::dogs()->featured()->get();
            $this->animals_not_featured = Animal::dogs()->notFeatured()->get();
            $this->animal_type = "dog";
        }

        if ($this->currentRoute == 'show-cats') {
            $this->animals_featured = Animal::cats()->featured()->get();
            $this->animals_not_featured = Animal::cats()->notFeatured()->get();
            $this->animal_type = "cat";
        }

        if ($this->currentRoute == 'show-others') {
            $this->animals_featured = Animal::others()->featured()->get();
            $this->animals_not_featured = Animal::others()->notFeatured()->get();
            $this->animal_type = "other";
        }
    }

    public function render()
    {
        return view('components.home.animals');

        // return view('components.home.animals',  [
        //     'animals_featured=' => Animal::dogs()->featured()->paginate(5),
        //     'animals_not_featured=' => Animal::dogs()->notFeatured()->paginate(5),
        //     'animal_type' => "dog"
        // ]);
    }

    public function showAnimalDetail($id)
    {
        $animal = Animal::find($id);
        $this->animal = $animal;

        $this->redirect(route('show-animal-detail', ['id' => $animal->id]));
    }
}
