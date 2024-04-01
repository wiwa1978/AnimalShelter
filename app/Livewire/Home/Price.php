<?php

namespace App\Livewire\Home;

use Livewire\Component;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;

class Price extends Component
{
    public $organization;
    public $user;
    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user) {
            $this->organization = $this->user->organizations->first();
        }


    }
    public function render()
    {   
 
        return view('components.home.price');
    }
}
