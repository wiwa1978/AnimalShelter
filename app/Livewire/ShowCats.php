<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;
use App\Livewire\ShowAnimalDetail;

class ShowCats extends Component
{
    public $animals_featured;
    public $animals_not_featured;

    public function mount()
    {
        $this->animals_featured = Animal::cats()->featured()->get();
        $this->animals_not_featured = Animal::cats()->notFeatured()->get();
    }
    public function render()
    {
        //$this->animals_featured = Animal::all();
        return view('components.home.index');
    }
}
