@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <a href="{{ route('boards.show', ['board' => $board]) }}">&leftarrow; Back to {{ $board->name }}</a>

    <h2>
        <a href="#">{{ $post->user->name }}</a>
        @if ($post->user->is_admin())
            <sup>admin</sup>
        @endif
        >>
        {{ $post->title }}
    </h2>
    <p>{{ $post->body }}</p>
    <img src="{{ asset('/uploads/boards/' . $post->image) }}" alt="">

    <h3>Discusión</h3>

    @foreach ($post->responses as $response)
        <h4>
            <a href="#">
                {{ $response->user->name }}
            </a>
            @if ($response->user->is_admin())
                <sup>admin</sup>
            @endif
            >>
            {{ $response->title }}
        </h4>
        <p>{{ $response->body }}</p>
    @endforeach

    @auth
        <form action="{{ route('boards.reply', ['board' => $board, 'image_board_post' => $post]) }}" method="POST">
            @csrf

            <div>
                <label for="title">Título</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="body">Contenido</label>
                <textarea name="body" id="body" rows="5">{{ old('body') }}</textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Submit Reply</button>
        </form>
    @endauth
@endsection
