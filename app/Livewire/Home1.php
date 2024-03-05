<?php

namespace App\Livewire;

use App\Models\Animal;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('AnimalShelter - Home')]
class Home1 extends Component
{
    use WithPagination;

    public function render()
    {
        return view('components.home.home1', [
            'animals_featured' => Animal::featured()->paginate(4),
            'animals_not_featured' => Animal::notFeatured()->paginate(12),
        ]);
    }
}
