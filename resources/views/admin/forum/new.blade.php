@extends('layouts.app')

@section('title', 'Create Forum')

@section('content')
    <h1>Create Forum</h1>

    @include('layouts.includes.success_error')

    <form method="POST">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="parent">Parent</label>
            <select name="parent_id" id="parent">
                <option value="">Select a parent forum</option>
                @foreach ($forums as $forum)
                    @if (!$forum->parent_id)
                        <option value="{{ $forum->id }}" {{ old('parent') == $forum->id ? 'selected' : '' }}>
                            {{ $forum->name }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <button type="submit">Create Forum</button>
    </form>
@endsection
