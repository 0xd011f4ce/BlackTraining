@extends('layouts.app')

@section('title', 'Edit ' . $page->name)

@section('content')
    <a href="{{ route('admin.pages.show') }}">&leftarrow; Back to pages</a>
    <h1>Edit Page: {{ $page->name }}</h1>

    @include('layouts.includes.success_error')

    <form action="{{ route('admin.page.update', ['page' => $page]) }}" method="POST">
        @csrf
        @method('patch')

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $page->name }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="path">Path</label>
            <input type="text" name="path" value="{{ $page->path }}">
            @error('path')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="5" rows="5">{{ $page->content }}</textarea>
            <sub>*Markdown is supported</sub>
            @error('content')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="in_header">In header</label>
            <input type="checkbox" name="in_header" {{ $page->in_header ? 'checked' : '' }}>
        </div>

        <button type="submit">Update Page</button>
    </form>

    <form action="#" method="POST" style="margin-top: 6px">
        @csrf
        @method('delete')

        <button type="submit">Delete Page</button>
    </form>
@endsection
