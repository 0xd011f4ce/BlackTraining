@extends('layouts.app')

@section('title', $board->name)

@section('content')
    <h1>{{ $board->name }}</h1>
    <p>{{ $board->description }}</p>

    @auth
        <h2>Create a post</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="body">Body</label>
                <textarea name="body" id="body" rows="5">{{ old('body') }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>

            <button type="submit">Create Post</button>
        </form>
    @endauth

    <h2>Posts</h2>
    <ul>
        @foreach ($posts as $post)
            <li>
                <h3>{{ $post->title }} >> <span><a href="#">{{ $post->id }}</a></span></h3>
                <p>{{ $post->body }}</p>
                @if ($post->image)
                    <img src="{{ asset('uploads/boards/' . $post->image) }}" alt="{{ $post->title }}">
                @endif
            </li>
        @endforeach
    </ul>

    {{ $posts->links() }}
@endsection
