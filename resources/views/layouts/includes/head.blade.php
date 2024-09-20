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

        <a href="{{ route('home.index') }}">Inicio</a>
        <a href="{{ route('courses.index') }}">Cursos</a>
        <a href="{{ route('boards.index') }}">Boards</a>
        <a href="{{ route('forum.index') }}">Foro</a>

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
            <a href="{{ route('logout.index') }}">Cerrar sesión</a>
        @else
            <a href="{{ route('login.index') }}">'Iniciar sesión'</a>
            <a href="{{ route('signup.index') }}">'Crear Cuenta'</a>
        @endauth

        <br>

        <span id="a">black@training</span>:<span id="b">~/page</span><span id="c">$</span> cd
        ..<br>
        <span id="a">black@training</span>:<span id="b">~</span><span id="c">$</span> cd
        website<br>

        <span id="a">black@training</span>:<span id="b">~/website</span><span id="c">$</span>
        ./display-content <br>
