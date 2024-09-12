@extends('layouts.app')

@section('title', $course->name)

@section('content')
    @auth
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('admin.course.edit', ['course' => $course]) }}">Edit course</a>
        @endif
    @endauth

    <h1>{{ $course->name }}</h1>
    <p>Lessons: {{ count($course->lessons) }}</p>
    <p>Last updated: {{ $course->updated_at->diffForHumans() }}</p>

    <h2>Lessons:</h2>

    @foreach ($course->courseSections as $section)
        <h3>{{ $section->name }}</h3>
        <ul>
            @foreach ($section->courseLessons as $lesson)
                <li>
                    <a
                        href="{{ route('courses.lesson', ['course' => $course, 'lesson' => $lesson]) }}">{{ $lesson->name }}</a>
                </li>
            @endforeach
        </ul>
    @endforeach
@endsection
