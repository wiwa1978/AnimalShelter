<?php

namespace App\Livewire\Animals;

use App\Models\User;
use App\Models\Animal;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]
class AnimalDetail extends Component
{


    public $animal;
    public $photos;
    public $youtube_links;
    public $user;

    public function mount($id)
    {

        $this->animal = Animal::find($id);
        $this->user = User::find(Animal::find($id)->user_id);


        $this->photos = $this->animal->photos_additional;

        $this->youtube_links = $this->animal->youtube_links;

        //$this->youtube_links = explode(' ', $this->youtube_links);
    }

    public function render()
    {

        return view('components.animals.animal-detail');
    }

    public function viewAnimalsByOrganization($userId)
    {
    
        $this->redirect(route('show-animal-organization', ['userId' => $userId]));
    }

}
