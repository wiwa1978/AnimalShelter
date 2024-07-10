<?php

namespace App\Livewire\Animals;

use App\Models\Animal;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FavoriteButton extends Component
{
    public $animal;
    public bool $is_favorite=false;

    public function mount(Animal $animal)
    {
        $this->is_favorite = Auth::user()->favorites()->where('animal_id', $animal->id)->exists();
    }

    public function toggleFavorite($animal)
    {   
        $animal = Animal::findOrFail($animal);
        $animal->increment('total_favorited');
        Auth::user()->favorites()->toggle($animal->id);
        $this->mount($animal);
    }

    public function render()
    {
        return view('components.animals.animal-favorite-button', [
            'is_favorite' => $this->is_favorite
        ]);
    }
}
