<?php

namespace App\Livewire;

use Livewire\Component;
use App\Events\localization;
use Symfony\Component\HttpFoundation\Request;

class Map extends Component
{
    public $key;

    public function mount()
    {
        $this->key = env('MAPIFY_KEY');
    }

    public function render()
    {
        return view('livewire.map');
    }
}
