@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Todo</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('update', $todo->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $todo->title }}">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description">{{ $todo->description }}</textarea>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="completed" name="completed" {{ $todo->completed ? 'checked' : '' }}>
            <label class="form-check-label" for="completed">Completed</label>
        </div>
        <button type="submit" class="btn btn-primary">Update Todo</button>
    </form>
</div>
@endsection
