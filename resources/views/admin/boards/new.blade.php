@extends('layouts.app')

@section('title', 'Create new Image Board')

@section('content')
    <h2>Create new Image Board</h2>

    <form action="#" method="POST">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="identifier">Identifier</label>
            <input type="text" name="identifier" value="{{ old('identifier') }}">
            @error('identifier')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" rows="5">{{ old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Create Board</button>
    </form>
@endsection
