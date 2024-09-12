@extends('layouts.app')

@section('title', $lesson->name . ' - ' . $course->name)

@section('content')
    <a href="{{ route('courses.show', ['course' => $course]) }}">&leftarrow; Back to course</a>

    {!! $content !!}
@endsection
