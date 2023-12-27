<?php

namespace App\Livewire;

use Livewire\Component;


class Home extends Component
{
    public $animals;

    public function render()
    {
        return view('components.home');
    }
}
