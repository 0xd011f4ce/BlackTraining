@php
    $isadmin = false;
    if (Auth::check()) {
        $isadmin = Auth::user()->is_admin();
    }
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | BlackTraining</title>

    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body>

    <div id="console">
        <span id="a">black@training</span>:<span id="b">~</span><span id="c">$</span> cd page<br>
        <span id="a">black@training</span>:<span id="b">~/page</span><span id="c">$</span>
        ls<br>

        <a href="{{ route('home.index') }}">Home</a>
        <a href="{{ route('courses.index') }}">Courses</a>
        <a href="#">Images</a>
        <a href="#">Forum</a>

        @php
            $pages = App\Models\Page::where('in_header', true)->get();
        @endphp

        @foreach ($pages as $page)
            <a href="{{ route('pages.show', ['page' => $page]) }}">
                {{ $page->name }}
            </a>
        @endforeach

        @auth
            @if ($isadmin)
                <a href="{{ route('admin.index') }}">Admin</a>
            @endif
            <a href="{{ route('logout.index') }}">Logout</a>
        @else
            <a href="{{ route('login.index') }}">Login</a>
            <a href="{{ route('signup.index') }}">Sign Up</a>
        @endauth

        <br>

        <span id="a">black@training</span>:<span id="b">~/page</span><span id="c">$</span> cd
        ..<br>
        <span id="a">black@training</span>:<span id="b">~</span><span id="c">$</span> cd
        website<br>

        <span id="a">black@training</span>:<span id="b">~/website</span><span id="c">$</span>
        ./display-content <br>
