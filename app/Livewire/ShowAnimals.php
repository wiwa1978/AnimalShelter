<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;
use App\Livewire\ShowAnimalDetail;

class ShowAnimals extends Component
{
    public $animal;
    public $animals_featured;
    public $animals_not_featured;

    public function render()
    {
        $this->animals_featured = Animal::isFeatured()->get();
        $this->animals_not_featured = Animal::isNotFeatured()->get();

        //dd($this->animals_not_featured);
        return view('components.animals.show-animals');
    }

    public function showAnimalDetail($id)
    {
        $animal = Animal::find($id);
        $this->animal = $animal;

        $this->redirect(route('show-animal-detail', ['id' => $animal->id]));
    }
}
