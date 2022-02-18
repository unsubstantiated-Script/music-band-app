@extends('dashboard')
@section('content')

    {{-- Making use of the router helper --}}
    @can('create', App\Models\User::class)
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add a User</a>
        {{ $users->links() }}
    @endcan

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><a href="{{ route('users.index', ['name']) }}">Name</a></th>
                <th>Email</th>
                <th><a href="{{ route('users.index', ['role']) }}">Role</a></th>
                <th></th>
                @can('viewAny', App\Models\User::class)
                    <th></th>
                    <th></th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td><a href="{{ route('users.show', $user->id) }}">Show Detail</a></td>
                    @can('viewAny', App\Models\User::class)
                        <td><a href="{{ route('users.edit', $user->id) }}">Edit user</a></td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
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
    {{ $users->links() }}

@endsection
