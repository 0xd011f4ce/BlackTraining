@extends('layouts.app')

@section('title', 'Edit ' . $post->name)

@section('content')
    <table border="1" cellpadding="10" cellspacing="0" width="100%">

        <tr>
            <td colspan="2" align="center">
                <strong>Editar Post</strong>
            </td>
        </tr>

        <form action="#" method="POST">
            @csrf

            <tr>
                <td width="20%" align="right"><strong>Título:</strong></td>
                <td width="80%">
                    <input type="text" name="title" placeholder="Ingresa el título aquí" value="{{ $post->name }}">
                    @error('title')
                        <br>
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>

            <tr>
                <td width="20%" align="right" valign="top"><strong>Contenido:</strong></td>
                <td width="80%">
                    <textarea name="content" cols="50" rows="10" placeholder="Ingresa el contenido aquí">{{ $post->content }}</textarea>
                    @error('content')
                        <br>
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>

            <tr>
                <td width="20%" align="right"><strong>Tags (opcional):</strong></td>
                <td width="80%">
                    <input type="text" name="tags" placeholder="Ingresa las tags separadas por coma"
                        value="{{ $post->tags }}">
                    @error('tags')
                        <br>
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <button type="submit">Editar Post</button>
                </td>
            </tr>
        </form>

    </table>
@endsection
