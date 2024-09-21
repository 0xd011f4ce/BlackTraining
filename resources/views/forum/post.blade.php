@extends('layouts.app')

@section('title', 'Post at ' . $forum->name)

@section('content')
    <table border="1" cellpadding="10" cellspacing="0" width="100%">

        <tr>
            <td colspan="2" align="center">
                <strong>Crea un Nuevo Post</strong>
            </td>
        </tr>

        <form action="#" method="POST">
            @csrf

            <tr>
                <td width="20%" align="right"><strong>Título:</strong></td>
                <td width="80%">
                    <input type="text" name="title" placeholder="Ingresa el título aquí" value="{{ old('title') }}">
                    @error('title')
                        <br>
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>

            <tr>
                <td width="20%" align="right" valign="top"><strong>Contenido:</strong></td>
                <td width="80%">
                    <textarea name="content" cols="50" rows="10" placeholder="Ingresa el contenido aquí">{{ old('content') }}</textarea>
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
                        value="{{ old('tags') }}">
                    @error('tags')
                        <br>
                        <p class="error">{{ $message }}</p>
                    @enderror
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center">
                    <button type="submit">Crear Post</button>
                </td>
            </tr>
        </form>

    </table>
@endsection
