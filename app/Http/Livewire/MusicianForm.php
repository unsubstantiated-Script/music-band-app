<?php

namespace App\Http\Livewire;

use App\Models\Musician;
use Livewire\Component;

class MusicianForm extends Component
{
    public $musician;

    public $firstName;
    public $lastName;
    public $instrument;
    public $website;
    public $status = "";

    public function mount($musician)
    {

        $this->musician = null;

        //This will mount values on the edit route
        if ($musician) {
            $this->musician = $musician;
            $this->firstName = $this->musician->first_name;
            $this->lastName = $this->musician->last_name;
            $this->instrument = $this->musician->instrument;
            $this->website = $this->musician->website;
        }

    }

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

    public function submitMusician()
    {
        $this->validate();

        //Okay so this is crazy, but if the form is getting passed a musician parameter, then it's gonna bump to updating eloquent method, else it will create a new musician
        if ($this->musician) {
            $this->status = "updated";
            Musician::find($this->musician->id)->update(
                [
                    'first_name' => $this->firstName,
                    'last_name' => $this->lastName,
                    'instrument' => $this->instrument,
                    'website' => $this->website,
                ]
            );
        } else {
            $this->status = "added";
            Musician::create(
                [
                    'first_name' => $this->firstName,
                    'last_name' => $this->lastName,
                    'instrument' => $this->instrument,
                    'website' => $this->website,
                ]
            );
        }
        return redirect()->route('musicians-livewire')->with('success', "Rock n Rolla was successfully " . $this->status);
    }

    public function render()
    {
        return view('livewire.musician-form');
    }
}
