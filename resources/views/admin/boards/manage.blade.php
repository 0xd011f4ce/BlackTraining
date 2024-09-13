@extends('layouts.app')

@section('title', 'Manage Boards')

@section('content')
    <h1>Manage Boards</h1>

    @include('layouts.includes.success_error')

    <ul>
        @foreach ($boards as $board)
            <li>
                <a href="{{ route('admin.board.edit', ['board' => $board]) }}">{{ $board->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
