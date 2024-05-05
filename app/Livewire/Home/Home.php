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
                'dogs_featured' => Animal::dogs()->published()->featured()->paginate(4),
                'cats_featured' => Animal::cats()->published()->featured()->paginate(4),
                'others_featured' => Animal::others()->published()->featured()->paginate(4),
                'dogs_featured_count' => Animal::dogs()->published()->featured()->count(),
                'cats_featured_count' => Animal::cats()->published()->featured()->count(),
                'others_featured_count' => Animal::others()->published()->featured()->count(),
                'dogs_count' => Animal::dogs()->published()->count(),
                'cats_count' => Animal::cats()->published()->count(),
                'others_count' => Animal::others()->published()->count(),
            ]);
    }
}
