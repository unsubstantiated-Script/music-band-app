@extends('dashboard')

@section('content')
    <div class="column col-3">
        <h3>Edit User</h3>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="toast toast-error">
                    <span> {{ $error }}</span>
                </div>
            @endforeach
        @endif
        <form method="POST" action={{ route('users.update', $user->id) }}>
            @csrf
            @method('PUT')
            <div class="form-group">
                @include('users.form')
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update User</button>
                <a class="btn btn-error" href="{{ route('users.index') }}">Cancel</a>
            </div>
        </form>

    </div>
@endsection
