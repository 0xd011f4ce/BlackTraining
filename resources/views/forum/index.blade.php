@extends('layouts.app')

@section('title', 'Forum')

@section('content')
    <table border="1" cellpadding="10" cellspacing="0" width="100%">

        @auth
            <tr>
                <td colspan="4" align="center">
                    <a href="#">Marcar como leídos</a> |
                    <a href="#">Nuevos Posts</a> |
                    <a href="#">Buscar</a> |
                    <a href="#">Miembros</a>
                </td>
            </tr>
        @endauth

        <tr>
            <th>Foro</th>
            <th>Temas</th>
            <th>Posts</th>
            <th>Último post</th>
        </tr>

        @foreach ($forums as $forum)
            @if (!$forum->parent_id)
                <tr>
                    <td colspan="4">
                        <strong>{{ $forum->name }}</strong><br>
                        {{ $forum->description }}
                    </td>
                </tr>

                @foreach ($forum->children as $child)
                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="5" style="border: none">
                                <tr>
                                    <td style="border: 0">
                                        <a href="#"><strong>{{ $child->name }}</strong></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 0">
                                        <em>{{ $child->description }}</em>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td align="center">{{ $child->topics }}</td>
                        <td align="center">{{ $child->posts }}</td>

                        <td>
                            <strong>TODO:</strong>
                            <em>Last post</em>
                        </td>
                    </tr>
                @endforeach
            @endif
        @endforeach

    </table>
@endsection
