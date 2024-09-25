@extends('layouts.app')

@section('title', $thread->name)

@section('content')
    <table border="1" cellpadding="10" cellspacing="0" width="100%">

        <tr>
            <td colspan="2" align="center">
                <strong>{{ $thread->name }}</strong>
            </td>
        </tr>

        <tr>
            <td width="20%" valign="top">
                <table width="100%" style="border: 0" cellpadding="5">

                    <tr>
                        <td style="border: 0">
                            <strong>Usuario: </strong> {{ $thread->user->name }}
                        </td>
                    </tr>

                    <tr>
                        <td style="border: 0">
                            <strong>Se Unió:</strong> {{ $thread->user->created_at->format('d/m/Y') }}
                        </td>
                    </tr>

                    <tr>
                        <td style="border: 0">
                            <strong>Posts:</strong> {{ $thread->user->forumPosts->count() }}
                        </td>
                    </tr>

                    <tr>
                        <td style="border: 0">
                            <strong>Nivel:</strong> {{ $thread->user->level }}
                        </td>
                    </tr>

                </table>
            </td>

            <td width="80%" valign="top">
                <strong>Posteado en: {{ $thread->created_at->format('d/m/Y') }}</strong><br><br>
                {!! nl2br(e($thread->content)) !!}

                @auth
                    @if (auth()->id() === $thread->user_id)
                        <br>
                        <a
                            href="{{ route('forum.edit', ['forum_category' => $thread->forumCategory, 'forum_post' => $thread]) }}">Editar
                            Post</a>
                    @endif
                @endauth
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <strong>Respuestas</strong>
            </td>
        </tr>

        @foreach ($thread->postReplies as $reply)
            <tr>
                <td width="20%" valign="top">
                    <table width="100%" style="border: 0" cellpadding="5">
                        <tr>
                            <td style="border: 0">
                                <strong>Usuario:</strong> {{ $reply->user->name }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0">
                                <strong>Se Unió:</strong> {{ $reply->user->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0">
                                <strong>Posts:</strong> {{ $reply->user->forumPosts->count() }}
                            </td>
                        </tr>
                    </table>
                </td>

                <td width="80%" valign="top">
                    <strong>Respondió el: {{ $reply->created_at->format('d/m/Y') }}</strong><br><br>
                    {!! nl2br(e($reply->content)) !!}
                </td>
            </tr>
        @endforeach

        @auth
            <tr>
                <td>
                    <strong>Postear respuesta:</strong>
                </td>
                <td>
                    <form action="#" method="POST">
                        @csrf
                        <textarea name="reply" id="reply" rows="5"></textarea><br>
                        <button type="submit">Responder</button>
                    </form>
                </td>
            </tr>
        @endauth

    </table>
@endsection
