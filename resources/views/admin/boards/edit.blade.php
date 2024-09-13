@extends('layouts.app')

@section('title', 'Edit Board: ' . $board->name)

@section('content')
    <a href="{{ route('admin.boards.show') }}">&leftarrow; Back to boards</a>
    <h1>Edit Board: {{ $board->name }}</h1>

    @include('layouts.includes.success_error')

    <form action="#" method="POST">
        @csrf
        @method('patch')

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $board->name }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="identifier">Identifier</label>
            <input type="text" name="identifier" id="identifier" value="{{ $board->identifier }}">
            @error('identifier')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" cols="5" rows="5">{{ $board->description }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Update Information</button>
    </form>

    <form action="#" method="POST" style="margin-top: 6px">
        @csrf
        @method('delete')

        <button type="submit">Delete</button>
    </form>
@endsection
