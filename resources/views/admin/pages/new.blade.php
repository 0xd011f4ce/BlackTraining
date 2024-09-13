@extends('layouts.app')

@section('title', 'Create new page')

@section('content')
    <h1>Create Page</h1>

    <form action="#" method="POST">
        @csrf

        @include('layouts.includes.success_error')

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="path">Path</label>
            <input type="text" name="path" value="{{ old('path') }}">
            <sub>*Don't include the leading forward slash (/)</sub>
            @error('path')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="content">Content</label>
            <textarea name="content" id="content" rows="5">{{ old('content') }}</textarea>
            <sub>*Markdown is supported</sub>
            @error('content')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Create Page</button>
    </form>
@endsection
