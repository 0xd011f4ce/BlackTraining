@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <a href="{{ route('boards.show', ['board' => $board]) }}">&leftarrow; Back to {{ $board->name }}</a>

    <h2>{{ $post->title }}</h2>
    <p>{{ $post->body }}</p>
    <img src="{{ asset('/uploads/boards/' . $post->image) }}" alt="">

    <h3>Discussion</h3>

    <form action="#" method="POST">
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

        <button type="submit">Submit Reply</button>
    </form>
@endsection
