<?php

namespace App\Livewire\Animals;

use App\Models\User;
use App\Models\Animal;
use Livewire\Component;


class AnimalsByOrganization extends Component
{
    public $userId;
    public $user;
    public $animals;

    public function mount($userId)
    {
        $this->userId = $userId;
        $this->user = User::find($userId);
        
        //$this->animals = Animal::find($this->userId)->get();
        $this->animals = Animal::where('user_id', $this->userId)->get();
        //dd($this->animals);
    }

    public function render()
    {
        

        return view('components.animals.animals-organization');
    }
}
