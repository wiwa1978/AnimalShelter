<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use App\Models\Animal;
use Livewire\Component;

#[Layout('layouts.app')]
class showAnimalDetail extends Component
{

    public $animal;
    public $photos;
    public $youtube_links;

    public function mount($id)
    {

        $this->animal = Animal::find($id);
        $this->photos = $this->animal->photos_additional;


        $this->youtube_links = $this->animal->youtube_links;
        $this->youtube_links = explode(' ', $this->youtube_links);
    }

    public function render()
    {

        return view('components.home.show-animal-detail');
    }
}
