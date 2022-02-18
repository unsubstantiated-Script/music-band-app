<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class ShowMusicians extends Component
{
    use WithPagination;

    //Setting up values for user input/interaction
    public $search = '';

    public $musician;

    public $sortBy = 'first_name';
    public $direction = 'ASC';

    public $queryCount = 10;


    protected $queryString = [
        "search" => ['except' => ''],
        "sortBy" => ['except' => ''],
        "direction" => ['except' => ''],
    ];

    public function doSort($field, $direction)
    {
        $this->sortBy = $field;
        $this->direction = $direction;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // $paginator->links('view.name');
    public function obliterateMusician($id)
    {
        $musician = \App\Models\Musician::find($id);
        $musician->delete();

        return redirect()->route('musicians-livewire')->with('destroyed', 'Rock n Rolla was successfully obliterated');
    }

    public function render()
    {
        //Changed this up to append in commands so that caps wouldn't make a difference in the query
        $orderClause = 'UPPER(' . $this->sortBy . ')' . $this->direction;

        if ($this->queryCount == "all") {
            $musicians = \App\Models\Musician::where('first_name', 'like', "%$this->search%")
                ->orWhere('last_name', 'like', "%$this->search%")
                ->orWhere('instrument', 'like', "%$this->search%")
                ->orderByRaw($orderClause)
                ->get();
        } else {
            $musicians = \App\Models\Musician::where('first_name', 'like', "%$this->search%")
                ->orWhere('last_name', 'like', "%$this->search%")
                ->orWhere('instrument', 'like', "%$this->search%")
                ->orderByRaw($orderClause)
                ->paginate($this->queryCount)
            ;

            $musicians->appends($this->sortBy, $this->direction, $this->queryCount)->links();
        }

        return view('livewire.show-musicians', compact('musicians'));
    }

}
