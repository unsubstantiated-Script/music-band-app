<?php

namespace App\Http\Livewire;

use App\Models\Musician;
use Livewire\Component;

class EditMusician extends Component
{

    public $musician;

    //Finding the data to pass it on through to the form
    public function mount(Musician $musician)
    {
        $this->musician = $musician;
    }

    public function render()
    {
        return view('livewire.edit-musician');
    }
}
