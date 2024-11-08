<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GraphHopperService;
use App\Events\localization;
use Symfony\Component\HttpFoundation\Request;

class Map extends Component
{
    public $key;
    protected $graphHopperService;

    public function mount(GraphHopperService $graphHopperService)
    {
        $this->graphHopperService = $graphHopperService;
        $this->key = env('MAPIFY_KEY');
    }

    public function render()
    {
        return view('livewire.map');
    }
}
