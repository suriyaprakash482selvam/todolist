
@extends('layouts.app')

@section('content')
    <h1>Confirm Deletion</h1>

    <p>Are you sure you want to delete this todo?</p>

    <form method="POST" action="{{ route('destroy', $todo->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Confirm Deletion</button>
    </form>
@endsection
