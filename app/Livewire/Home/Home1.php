<?php

namespace App\Livewire\Home;

use App\Models\Animal;
use Livewire\Component;
use App\Enums\AnimalType;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('AnimalShelter - Home')]
class Home1 extends Component
{
    use WithPagination;

    public $searchTerm;
    public $animaltypes;
    public $animaltypess = ['Dog', 'Cat', 'Other'];

    public function updatedAnimalTypes($value)
    {
        dd($value);

        // if (!is_array($this->animaltypes))  return;
        
        // $this->animaltypes = array_filter($this->animaltypes, function($animaltype) {
        //     return $animaltype != false;
        // });
        
    }


    public function render()
    {
        //dd($this->animaltypes);
        //$animals = Animal::whereLike('name', $this->search ?? '')->get();
        //dd($animals);
        // return view('components.home.home1', [
        //     'animals_featured' => Animal::featured()->paginate(4),
        //     'animals_not_featured' => Animal::notFeatured()->paginate(12),
        // ]);
        
            
        return view('components.home.home1', [
            'animals_featured' => Animal::featured(),
            'animals_not_featured' => Animal::whereLike('name', $this->searchTerm ?? '')
                ->when($this->animaltypes, function($query, $animaltypes) {
                    return $query->whereIn('animal_type', $animaltypes);
                })
                ->get(),
            //'animals_not_featured' => Animal::search('name', $this->searchTerm ?? '')->paginate(12)
        ]);
    }
}
