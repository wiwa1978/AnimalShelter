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

    public $animals_all;
    public $animals_featured;
    public $animals_not_featured;
    public $currentRoute;
    public $animal_type;

    public $animal_featured_count;

    public $animal_not_featured_count;

    public function mount()
    {
        $this->currentRoute = Route::currentRouteName();

        if ($this->currentRoute == 'show-dogs') {
            $this->animals_all = Animal::dogs()->get();
            $this->animals_featured = Animal::dogs()->featured()->get();
            $this->animals_not_featured = Animal::dogs()->notFeatured()->get();
            $this->animal_type = "dog";
            $this->animal_featured_count = Animal::dogs()->featured()->count();
            $this->animal_not_featured_count = Animal::dogs()->notFeatured()->count();
        }

        if ($this->currentRoute == 'show-cats') {
            $this->animals_all = Animal::cats()->get();
            $this->animals_featured = Animal::cats()->featured()->get();
            $this->animals_not_featured = Animal::cats()->notFeatured()->get();
            $this->animal_type = "cat";
            $this->animal_featured_count = Animal::cats()->featured()->count();
            $this->animal_not_featured_count = Animal::cats()->notFeatured()->count();
        }

        if ($this->currentRoute == 'show-others') {
            $this->animals_all = Animal::others()->get();
            $this->animals_featured = Animal::others()->featured()->get();
            $this->animals_not_featured = Animal::others()->notFeatured()->get();
            $this->animal_type = "other";
            $this->animal_featured_count = Animal::others()->featured()->count();
            $this->animal_not_featured_count = Animal::others()->notFeatured()->count();
        }
    }

    public function render()
    {
        return view('components.animals.animals');

        // return view('components.animals.animals',  [
        //     'animals_all' => Animal::dogs()->get(),
        //     'animals_featured' => Animal::dogs()->featured()->paginate(5),
        //     'animals_not_featured' => Animal::dogs()->notFeatured()->paginate(5),
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
