@section('title')
    Musicians Listing
@endsection
<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session()->get('success'))
            <div class="toast toast-success">
                {{ session()->get('success') }}
            </div>
        @elseif (session()->get('destroyed'))
            <div class="toast toast-error">
                {{ session()->get('destroyed') }}
            </div>
        @endif
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-3 bg-white border-b border-gray-200">
                <div class="container m-2">
                    <div class="mb-5">
                        <a href="{{ route('add-musician') }}" class="btn btn-primary">Add a Musician</a>
                    </div>
                    <div class="mb-5">
                        <input wire:model="search" type="text" placeholder="Search by First/Last Name or Instrument"
                            size="40">
                    </div>
                    <div> {{ $queryCount == 'all' ? '' : $musicians->links() }}</div>
                    <div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="#" wire:click="doSort('first_name', 'ASC')">&uarr;</a>
                                        First Name
                                        <a href="#" wire:click="doSort('first_name', 'DESC')">&darr;</a>
                                    </th>
                                    <th>
                                        <a href=" #" wire:click="doSort('last_name', 'ASC')">&uarr;</a>
                                        Last Name
                                        <a href="#" wire:click="doSort('last_name', 'DESC')">&darr;</a>
                                    </th>
                                    <th>
                                        <a href=" #" wire:click="doSort('instrument', 'ASC')">&uarr;</a>
                                        Instrument
                                        <a href="#" wire:click="doSort('instrument', 'DESC')">&darr;</a>
                                    </th>
                                    <th>
                                        Website
                                    </th>
                                    <th></th>
                                    <th>
                                        <select name="queryCount" wire:model="queryCount" class="border">
                                            <option value="10" default>10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="all">All</option>
                                        </select>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($musicians as $musician)
                                    <tr>
                                        <td>{{ $musician->first_name }}</td>
                                        <td>{{ $musician->last_name }}</td>
                                        <td>{{ $musician->instrument }}</td>
                                        <td>{{ $musician->website }}</td>
                                        <td>
                                            <a class="btn btn-secondary"
                                                href="{{ route('edit-musician', ['musician' => $musician->id]) }}">Edit
                                                Musician</a>
                                        </td>
                                        <td>
                                            <button class="btn btn-error"
                                                onClick="return confirm('Are you sure you want to delete this?')"
                                                wire:click.prevent="obliterateMusician({{ $musician->id }})">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="my-6">{{ $queryCount == 'all' ? '' : $musicians->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
