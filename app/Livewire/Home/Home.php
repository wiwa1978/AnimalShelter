<?php

namespace App\Livewire\Home;

use App\Models\Animal;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('AnimalShelter - Home')]
class Home extends Component
{
    use WithPagination;

    public function render()
    {

        return view('components.home.home1',
            [
                'dogs_featured' => Animal::dogs()->featured()->paginate(4),
                'cats_featured' => Animal::cats()->featured()->paginate(4),
                'others_featured' => Animal::others()->featured()->paginate(4),
                'dogs_featured_count' => Animal::dogs()->featured()->count(),
                'cats_featured_count' => Animal::cats()->featured()->count(),
                'others_featured_count' => Animal::others()->featured()->count(),
                'dogs_count' => Animal::dogs()->count(),
                'cats_count' => Animal::cats()->count(),
                'others_count' => Animal::others()->count(),
            ]);
    }
}
