@extends('dashboard')
@section('content')

    <h3>Show user detail</h3>
    <ul>
        <li>Name: {{ $user->name }}</li>
        <li>Email: {{ $user->email }}</li>
        <li>Role: {{ $user->role }}</li>
    </ul>
    <p>
        <a class="btn btn-secondary" href="{{ route('users.index') }}">Back to all Users</a>
    </p>
@endsection
