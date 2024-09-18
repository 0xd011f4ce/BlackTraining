@extends('layouts.app')

@section('title', 'Manage Courses')

@section('content')
    <h1>Manage Courses</h1>

    @include('layouts.includes.success_error')

    <ul>
        @foreach ($courses as $course)
            <li>
                <a href="{{ route('admin.course.edit', ['course' => $course]) }}">{{ $course->name }}</a>
                <p>Published:
                    @if ($course->published)
                        <span class="success">true</span>
                    @else
                        <span class="error">false</span>
                    @endif
                </p>
                <p>Duration: {{ $course->duration }}</p>
            </li>
        @endforeach
    </ul>
@endsection
