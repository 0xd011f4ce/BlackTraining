@extends('layouts.app')

@section('title', 'Manage Pages')

@section('content')
    <h1>Manage Pages</h1>

    <ul>
        @foreach ($pages as $page)
            <li>
                <a href="{{ route('admin.page.edit', ['page' => $page]) }}">{{ $page->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
