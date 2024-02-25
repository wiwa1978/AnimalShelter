<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;
use Illuminate\Support\Facades\Route;
use App\Livewire\ShowAnimalDetail;

class ShowAnimals extends Component
{
    public $animal;
    public $animals_featured;
    public $animals_not_featured;
    public $currentRoute;
    public $type;

    public function mount()
    {
        $this->currentRoute = Route::currentRouteName();

        if ($this->currentRoute == 'show-dogs') {
            $this->animals_featured = Animal::dogs()->featured()->get();
            $this->animals_not_featured = Animal::dogs()->notFeatured()->get();
            $this->type = "dog";
        }

        if ($this->currentRoute == 'show-cats') {
            $this->animals_featured = Animal::cats()->featured()->get();
            $this->animals_not_featured = Animal::cats()->notFeatured()->get();
            $this->type = "cat";
        }

        if ($this->currentRoute == 'show-others') {
            $this->animals_featured = Animal::others()->featured()->get();
            $this->animals_not_featured = Animal::others()->notFeatured()->get();
            $this->type = "other";
        }
    }

    public function render()
    {
        return view('components.home.animals');
    }

    public function showAnimalDetail($id)
    {
        $animal = Animal::find($id);
        $this->animal = $animal;

        $this->redirect(route('show-animal-detail', ['id' => $animal->id]));
    }
}
