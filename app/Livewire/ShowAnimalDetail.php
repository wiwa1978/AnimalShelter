<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;

class showAnimalDetail extends Component
{

    public $animal;

    public function mount($id)
    {

        $this->animal = Animal::find($id);
    }

    public function render()
    {
        return view('components.animals.show-animal-detail');
    }
}
