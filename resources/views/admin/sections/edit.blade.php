@extends('layouts.app')

@section('title', 'Edit ' . $course_section->name)

@section('content')
    <a href="{{ route('admin.course.edit', ['course' => $course]) }}">&leftarrow; Back to {{ $course->name }}</a>

    <h1>Edit: {{ $course_section->name }}</h1>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form action="#" method="POST">
        @csrf
        @method('patch')

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $course_section->name }}">
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" rows="5">{{ $course_section->description }}</textarea>
        </div>

        <button type="submit" name="submit">Update Information</button>
    </form>

    <h2>Lessons</h2>

    <ul>
        @foreach ($course_section->lessons as $lesson)
            <li>
                {{ $lesson->name }}
                <div style="display: flex; justify-items: center; align-items: center">
                    <a href="#" class="button">Edit</a>
                    &middot;
                    <form action="/" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this lesson?')">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <h3>Create Lesson</h3>

    <form
        action="{{ route('admin.course.sections.lessons.store', ['course' => $course, 'course_section' => $course_section]) }}"
        method="POST">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" name="lesson_name" value="{{ old('lesson_name') }}">
        </div>

        <div>
            <label for="description">Content</label>
            <textarea name="lesson_content" rows="5">
                {{ old('lesson_content') }}
            </textarea>
            <sub>* Markdown is supported</sub>
        </div>

        <button type="submit" name="submit">Create Lesson</button>
    </form>
@endsection
