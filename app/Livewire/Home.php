<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('AnimalShelter - Home')]
class Home extends Component
{
    public $animals_featured;
    public $animals_not_featured;


    public function mount()
    {
        $this->animals_featured = Animal::featured()->get();
        $this->animals_not_featured = Animal::notFeatured()->get();
    }

    public function render()
    {
        //$this->animals_featured = Animal::all();
        //return view('components.home.index');
        return view('components.home.home');
    }
}
