@extends('layouts.app')

@section('title', 'Edit: ' . $course->name)

@section('content')
    <a href="{{ route('admin.courses.show') }}">&leftarrow; Back to courses</a>

    <h1>Edit Course: {{ $course->name }}</h1>

    @include('layouts.includes.success_error')

    <form action="{{ route('admin.course.update', ['course' => $course]) }}" method="POST">
        @csrf
        @method('patch')
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ $course->name }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" rows="5">{{ $course->description }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="duration">Duration</label>
            <input type="text" name="duration" value="{{ $course->duration }}">
            @error('duration')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="published">Published</label>
            <input type="checkbox" name="published" {{ $course->published ? 'checked' : '' }}>
        </div>

        <button type="submit" name="submit">Update Information</button>
    </form>

    <form action="#" method="POST" style="margin-top: 6px">
        @csrf
        @method('delete')

        <button type="submit">Delete Course</button>
    </form>

    <h2>Sections</h2>

    <ul>
        @foreach ($course->courseSections as $section)
            <li>
                {{ $section->name }}
                <div style="display: flex; align-items: center">
                    <a href="{{ route('admin.course.sections.edit', ['course' => $course, 'course_section' => $section]) }}"
                        class="button">Edit</a>

                    &middot;

                    <form
                        action="{{ route('admin.course.sections.destroy', ['course' => $course, 'course_section' => $section]) }}"
                        method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" name="submit"
                            onclick="return confirm ('Are you sure you want to delete this section?')">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <form action="{{ route('admin.course.sections.store', ['course' => $course]) }}" method="POST">
        @csrf
        <h3>Create new section</h3>

        <div>
            <label for="section_name">Name</label>
            <input type="text" name="section_name" value="{{ old('section_name') }}">
        </div>

        <div>
            <label for="section_description">Description</label>
            <textarea name="section_description" rows="5">{{ old('section_description') }}</textarea>
        </div>

        <button type="submit" name="submit">Create Section</button>
    </form>
@endsection
