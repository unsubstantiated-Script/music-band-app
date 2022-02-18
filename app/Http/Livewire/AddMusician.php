<?php

namespace App\Http\Livewire;

use App\Models\Musician;
use Livewire\Component;

class AddMusician extends Component
{
    public $firstName;
    public $lastName;
    public $instrument;
    public $website;

    //Adding in validation
    protected $rules = [
        'firstName' => 'required|min:5',
        'lastName' => 'required|min:5',
        'instrument' => 'required|min:5',
        'website' => 'required|min:5',
    ];

    //customizing the error message
    protected $validationAttributes = [
        'firstName' => 'first name',
        'lastName' => 'last name',
        'instrument' => 'instrument',
        'website' => 'website',
    ];

    public function addMusician()
    {
        $this->validate();
        Musician::create(
            [
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'instrument' => $this->instrument,
                'website' => $this->website,
            ]
        );

        return redirect()->route('musicians-livewire')->with('success', 'Rock n Rolla was successfully added');
    }

    public function render()
    {
        return view('livewire.add-musician');
    }
}
