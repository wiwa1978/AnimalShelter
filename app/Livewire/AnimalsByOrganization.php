<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;


class AnimalsByOrganization extends Component
{
    public $userId;

    public function mount($userId)
    {
        $this->userId = $userId;
    }



    #[\Livewire\Attributes\On('view-animals')] 
    public function loadAnimals()
    {
        dd('test');

    }


    // public function render()
    // {
    //     $animals = Animal::where('user_id', $this->userId)->get();
    //     return view('components.home.animals-by-organization', ['animals' => $animals]);
    // }
}
