@extends('layouts.app')

@section('title', 'Log In')

@section('content')
    <span id="a">black@training</span>:<span id="b">~/website</span><span id="c">$</span>
    ./display-form <br>

    <h1>Log In</h1>

    @if (session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <form action="{{ route('login.store') }}" method="post">
        @csrf

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

        <button type="submit">Log In</button>
    </form>
@endsection
