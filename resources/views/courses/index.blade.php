@extends('layouts.app')

@section('title', 'Courses')

@section('content')
    <h1>Courses</h1>

    <p>The following is a list of all the available courses:</p>

    <ul>
        @foreach ($courses as $course)
            @if ($course->published)
                <li>
                    <a href="{{ route('courses.show', ['course' => $course]) }}">{{ $course->name }}</a>
                </li>
            @endif
        @endforeach
    </ul>
@endsection
