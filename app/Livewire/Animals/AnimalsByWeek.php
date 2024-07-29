<?php

namespace App\Livewire\Animals;

use App\Models\User;
use App\Models\Animal;
use Livewire\Component;
use App\Models\Organization;
use Illuminate\Support\Facades\Log;


class AnimalsByWeek extends Component
{
    const PER_PAGE = 12;
    //test


    public function render()
    {
        //dd(Animal::published()->week()->count());
        return view('components.animals.animals-week',  [
            'animals' =>Animal::published()->week()->paginate(self::PER_PAGE),
            //'animals_count' => Animal::dogs()->published()->count(),
        ]);
    }
      
    

}
