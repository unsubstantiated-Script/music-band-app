@extends('dashboard')

@section('content')
    <div class="column col-3">
        <h3>Add a Musician</h3>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="toast toast-error">
                    <span> {{ $error }}</span>
                </div>
            @endforeach
        @endif
        <form method="POST" action={{ route('musicians.store') }}>
            @csrf
            <div class="form-group">
                {{-- Componentizing the form --}}
                @include('musicians.form')
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Store Musician</button>
                <a class="btn btn-error" href="{{ route('musicians.index') }}">Cancel</a>
            </div>
        </form>

    </div>
@endsection
