<?php

namespace App\Livewire\Animals;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Animal;
use App\Models\Organization;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


#[Layout('layouts.app')]
class AnimalDetail extends Component
{

    public $isAnimalBelongsToShelter;
    public $days_adoptable;
    public $animal;
    public $photos;
    public $youtube_links;
    public $organization;

    public $photos_http;
    public $photos_media;


    public function mount(Animal $animal)
    {
        $dateAdded = Carbon::parse($animal->date_added); // assuming $date_added is your date
        $now = Carbon::now();
        
        
        $this->animal = $animal;
        $this->organization=$animal->organization;
       
        $this->isAnimalBelongsToShelter = Organization::isShelter($this->organization->id)->exists();
        $this->days_adoptable = (int) $dateAdded->diffInDays($now);
        
        //$this->photos = collect($this->animal->photos_additional)->take(3);

        $this->photos_http = collect($this->animal->photos_additional)
            ->filter(function ($photo) {
                return Str::startsWith($photo, 'http');
            })
            ->take(3);

        $this->photos_media = collect($this->animal->photos_additional)
            ->filter(function ($photo) {
                return Str::startsWith($photo, 'media');
            })
            ->take(3);

        //dd($this->photos_http);
        //$this->youtube_links = $this->animal->youtube_links;
        //$this->youtube_links = explode(' ', $this->youtube_links);
        if ($this->animal->youtube_links && is_array($this->animal->youtube_links)) {
            $this->youtube_links = array_column($this->animal->youtube_links, 'youtube_links');
        } else {
            $this->youtube_links = [];
        }
        //dd($this->youtube_links);


    }


    public function render()
    {
        return view('components.animals.animal-detail');
    }

    
    public function viewAnimalsByOrganization($organizationId)
    {
        $this->redirect(route('show-animal-organization', ['organization' => $organizationId]));
    }

}
