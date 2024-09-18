@extends('layouts.app')

@section('title', 'Courses')

@section('content')
    <h1>Cursos</h1>

    <p>La siguiente es una lista de cursos disponibles en BlackTraining:</p>

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
