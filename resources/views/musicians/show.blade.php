@extends('dashboard')
@section('content')

    <h3>Show musician detail</h3>
    <ul>
        <li>{{ $musician->first_name }}</li>
        <li>{{ $musician->last_name }}</li>
        <li>Instrument: a flaming {{ $musician->instrument }}</li>
        <li>Website: <a href="{{ $musician->website }}">{{ $musician->website }}</a></li>
    </ul>
    <p>
        <a class="btn btn-secondary" href="{{ route('musicians.index') }}">Back to all Musicians</a>
    </p>
@endsection
