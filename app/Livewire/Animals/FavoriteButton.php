<?php

namespace App\Livewire\Animals;

use App\Models\Animal;
use Livewire\Component;
use Maize\Markable\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteButton extends Component
{
    public $animal;
    public bool $is_favorite=false;

    public function mount(Animal $animal)
    {

        $this->is_favorite = Favorite::has($animal, Auth::user());

        //$this->is_favorite = Favorite::has($animal, Auth::user());
        // if (Auth::user()!==null) {
        //     $this->is_favorite = Favorite::has($animal, Auth::user());
        // }
        // else {
        //     return true;
        // }
      
       
    }

    public function toggleFav($animal)
    {   
        $animal = Animal::findOrFail($animal);
        Favorite::toggle($animal, Auth::user());
        $this->mount($animal);
    }

    public function toggle($animal)
    {   
       $animal = Animal::findOrFail($animal);
        Favorite::toggle($animal, Auth::user());
        $this->mount($animal);
    }


    public function render()
    {
        return view('components.animals.animal-favorite-button', [
            'is_favorite' => $this->is_favorite
        ]);
    }
}
