@extends('layouts.app')

@section('title', $forum->name)

@section('content')
    <table border="1" cellpadding="10" cellspacing="0" width="100%">

        <tr>
            <td colspan="5" align="center">
                <strong>Categoría: {{ $forum->name }}</strong><br>
                <em>{{ $forum->description }}</em><br>

                @auth
                    <a href="{{ route('forum.post', ['forum_category' => $forum]) }}">Nuevo Post</a>
                @endauth
            </td>
        </tr>

        <tr>
            <th width="50%">Título</th>
            <th width="15%">Autor</th>
            <th width="10%">Respuestas</th>
            <th width="10%">Visitas</th>
            <th width="15%">Último post</th>
        </tr>

        @foreach ($posts as $post)
            <tr>
                <td>
                    <a
                        href="{{ route('forum.thread', ['forum_category' => $forum, 'forum_post' => $post]) }}">{{ $post->name }}</a><br>
                    <em>Posteado en: {{ $post->created_at->format('d/m/Y') }}</em>
                </td>

                <td align="center">{{ $post->user->name }}</td>

                <td align="center">{{ $post->replies }}</td>

                <td align="center">{{ $post->views }}</td>

                <td>
                    @if ($post->lastReply)
                        <strong>Hecho por: </strong> {{ $post->lastReply->user->name }}<br>
                    @endif
                </td>
            </tr>
        @endforeach

    </table>
@endsection
