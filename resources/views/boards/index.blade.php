@extends('layouts.app')

@section('title', 'Image Boards')

@section('content')
    <h1>Boards</h1>

    <ul>
        @foreach ($boards as $board)
            <li>
                <a href="{{ route('boards.show', $board) }}">{{ $board->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
