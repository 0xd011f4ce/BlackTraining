@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h1>Admin Dashboard</h1>

    @include('layouts.includes.success_error')

    <h2>Courses</h2>
    <a href="{{ route('admin.courses.new.index') }}">Create new course</a><br>
    <a href="{{ route('admin.courses.show') }}">Manage courses</a>

    <h2>Pages</h2>
    <a href="{{ route('admin.pages.new.index') }}">Create new page</a><br>
    <a href="{{ route('admin.pages.show') }}">Manage pages</a>

    <h2>Image Boards</h2>
    <a href="{{ route('admin.boards.new.index') }}">Create new Board</a><br>
    <a href="{{ route('admin.boards.show') }}">Manage Boards</a>

    <h2>Forums</h2>
    <a href="{{ route('admin.forums.new.index') }}">Create new Forum</a>

    <br>
@endsection
