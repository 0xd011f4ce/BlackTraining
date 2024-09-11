@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')
    <span id="a">black@training</span>:<span id="b">~/website</span><span id="c">$</span>
    ./display-form <br>

    <h1>Sign Up</h1>

    <form action="{{ route('signup.store') }}" method="post">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
            @error('password_confirmation')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Sign Up</button>
    </form>
@endsection