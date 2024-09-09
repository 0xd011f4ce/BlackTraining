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

    <br>
@endsection
