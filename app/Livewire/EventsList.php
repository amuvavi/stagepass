<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event; 

class EventsList extends Component
{
    public $events;

    public function mount()
    {
        $this->events = Event::orderBy('date')->get();
    }

    public function render()
    {
        return view('livewire.events-list');
    }
}
