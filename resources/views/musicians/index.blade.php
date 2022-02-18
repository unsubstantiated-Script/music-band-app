@extends('dashboard')
@section('content')

    {{-- Making use of the router helper --}}
    @can('create', App\Models\Musician::class)
        <a href="{{ route('musicians.create') }}" class="btn btn-primary">Add a Musician</a>
    @endcan
    {{ $musicians->links() }}

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><a href="{{ route('musicians.index', ['first_name']) }}">First Name</a></th>
                <th><a href="{{ route('musicians.index', ['last_name']) }}">Last Name</a></th>
                <th><a href="{{ route('musicians.index', ['instrument']) }}">Instrument</a></th>
                <th><a href="{{ route('musicians.index', ['website']) }}">Website</a></th>
                <th></th>
                @can('viewAny', App\Models\Musician::class)
                    <th></th>
                    <th></th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($musicians as $musician)
                <tr>
                    <td>{{ $musician->first_name }}</td>
                    <td>{{ $musician->last_name }}</td>
                    <td>{{ $musician->instrument }}</td>
                    <td><a href="{{ $musician->website }}">{{ $musician->website }}</a></td>
                    <td><a href="{{ route('musicians.show', $musician->id) }}">Show Detail</a></td>
                    @can('viewAny', App\Models\Musician::class)
                        <td><a href="{{ route('musicians.edit', $musician->id) }}">Edit Musician</a></td>
                        <td>
                            <form action="{{ route('musicians.destroy', $musician->id) }}" method="POST"
                                onSubmit="return confirm('Are you sure you want to delete this?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-error" type="submit">Delete </button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $musicians->links() }}

@endsection
