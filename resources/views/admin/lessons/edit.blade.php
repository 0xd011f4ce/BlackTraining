@extends('layouts.app')

@section('title', 'Edit ' . $lesson->name)

@section('content')
    <a href="{{ route('admin.course.sections.edit', ['course' => $course, 'course_section' => $section]) }}">&leftarrow; Go
        back to: {{ $section->name }}</a>

    <h1>Edit Lesson: {{ $section->name }} - {{ $lesson->name }}</h1>

    @include('layouts.includes.success_error')

    <form method="POST">
        @csrf
        @method('patch')

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $lesson->name }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="content">Content</label>
            <textarea name="content" rows="20">{{ $lesson->content }}</textarea>
            @error('content')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Update Lesson</button>
    </form>
@endsection
