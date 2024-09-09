@extends('layouts.app')

@section('title', 'Create new course')

@section('content')
    <h1>Create Course</h1>

    <form action="{{ route('admin.courses.new.store') }}" method="POST">
        @csrf

        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
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

        <div>
            <label for="duration">Duration</label>
            <input type="text" name="duration" value="{{ old('duration') }}">
            @error('duration')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" name="submit">Create Course!</button>
    </form>
@endsection
