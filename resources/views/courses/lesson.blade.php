@extends('layouts.app')

@section('title', $lesson->name . ' - ' . $course->name)

@section('content')
    <a href="{{ route('courses.show', ['course' => $course]) }}">&leftarrow; Volver al curso</a>

    @auth
        @if (Auth::user()->role === 'admin')
            <a
                href="{{ route('admin.course.lessons.edit', ['course' => $course, 'course_section' => $lesson->section, 'course_lesson' => $lesson]) }}">Editar
                lección</a>
        @endif
    @endauth

    {!! $content !!}
@endsection
