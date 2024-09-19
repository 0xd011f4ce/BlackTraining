@extends('layouts.app')

@section('title', $board->name)

@section('content')
    <h1>
        {{ $board->name }}</h1>
    <p>{{ $board->description }}</p>

    @auth
        <h2>Crea un post</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
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

            <div>
                <label for="image">Imagen</label>
                <input type="file" name="image" id="image">
            </div>

            <button type="submit">Crear Post</button>
        </form>
    @endauth

    <h2>Posts</h2>
    <ul>
        @foreach ($posts as $post)
            @if (!$post->is_response)
                <li>
                    <h3><a href="#">{{ $post->user->name }}</a>

                        @if ($post->user->is_admin())
                            <sup>admin</sup>
                        @endif

                        >> {{ $post->title }} >>
                        <span>
                            <a href="{{ route('boards.thread', ['board' => $board, 'image_board_post' => $post]) }}">{{ $post->id }}
                                view thread</a>
                        </span>
                    </h3>
                    <p>{{ $post->body }}</p>
                    @if ($post->image)
                        <img src="{{ asset('uploads/boards/' . $post->image) }}" alt="{{ $post->title }}" width="240">
                    @endif
                </li>
            @endif
        @endforeach
    </ul>

    {{ $posts->links() }}
@endsection
