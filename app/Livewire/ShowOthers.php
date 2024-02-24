<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;
use App\Livewire\ShowAnimalDetail;

class ShowOthers extends Component
{
    public $animals_featured;
    public $animals_not_featured;

    public function mount()
    {
        $this->animals_featured = Animal::others()->featured()->get();
        $this->animals_not_featured = Animal::others()->notFeatured()->get();
    }
    public function render()
    {
        //$this->animals_featured = Animal::all();
        return view('components.home.index');
    }
}
