<?php

namespace App\Livewire\Home;

use App\Models\Animal;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('AnimalShelter - Home')]
class Home extends Component
{
    public $animals_featured;
    public $animals_not_featured;

    public function render()
    {

        return view('components.home.home');
    }
}
