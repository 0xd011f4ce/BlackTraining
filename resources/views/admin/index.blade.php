@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h1>Admin Dashboard</h1>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <h2>Courses</h2>
    <a href="{{ route('admin.courses.new.index') }}">Create new course</a><br>
    <a href="{{ route('admin.courses.show') }}">Manage courses</a>

    <h2>Users</h2>
    <a href="#">Manage users</a><br>

    <h2>Pages</h2>
    <a href="{{ route('admin.pages.new.index') }}">Create new page</a><br>
    <a href="{{ route('admin.pages.show') }}">Manage pages</a>

    <h2>Image Boards</h2>
    <a href="#">Create new Board</a><br>
    <a href="#">Manage Boards</a>

    <br>
@endsection
