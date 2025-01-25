@extends('layout.layout')

@section('title', 'Mi Perfil')

@section('content')

    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Modificar Perfil</h6>
        <form method="POST" action="{{ route('configuracion.perfil.update', $user->id) }}" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Contraseña:</label>
                <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Confirmar contraseña:</label>
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pregunta de Seguridad #1:</label>
                <select name="pregunta_secreta1" class="form-select mb-3" aria-label="Default select example">
                    <option hidden selected>{{$user->pregunta_secreta1}}</option>
                    <option value="Pregunta 1">Pregunta 1</option>
                    <option value="Pregunta 2">Pregunta 2</option>
                    <option value="Pregunta 3">Pregunta 3</option>
                    <option value="Pregunta 4">Pregunta 4</option>
                    <option value="Pregunta 5">Pregunta 5</option>
                    <option value="Pregunta 6">Pregunta 6</option>
                    <option value="Pregunta 7">Pregunta 7</option>
                    <option value="Pregunta 8">Pregunta 8</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Respuesta de Seguridad #1:</label>
                <input type="text" name="respuesta_secreta1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->respuesta_secreta1}}">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pregunta de Seguridad #2:</label>
                <select name="pregunta_secreta2" placeholder="Seleccionar una pregunta" class="form-select mb-3" aria-label="Default select example">
                    <option hidden selected>{{$user->pregunta_secreta2}}</option>
                    <option value="Pregunta 1">Pregunta 1</option>
                    <option value="Pregunta 2">Pregunta 2</option>
                    <option value="Pregunta 3">Pregunta 3</option>
                    <option value="Pregunta 4">Pregunta 4</option>
                    <option value="Pregunta 5">Pregunta 5</option>
                    <option value="Pregunta 6">Pregunta 6</option>
                    <option value="Pregunta 7">Pregunta 7</option>
                    <option value="Pregunta 8">Pregunta 8</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Respuesta de Seguridad #2:</label>
                <input type="text" name="respuesta_secreta2" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->respuesta_secreta2}}">
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Pregunta de Seguridad #3:</label>
                <select name="pregunta_secreta3" placeholder="Seleccionar una pregunta" class="form-select mb-3" aria-label="Default select example">
                    <option hidden selected>{{$user->pregunta_secreta3}}</option>
                    <option value="Pregunta 1">Pregunta 1</option>
                    <option value="Pregunta 2">Pregunta 2</option>
                    <option value="Pregunta 3">Pregunta 3</option>
                    <option value="Pregunta 4">Pregunta 4</option>
                    <option value="Pregunta 5">Pregunta 5</option>
                    <option value="Pregunta 6">Pregunta 6</option>
                    <option value="Pregunta 7">Pregunta 7</option>
                    <option value="Pregunta 8">Pregunta 8</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Respuesta de Seguridad #3:</label>
                <input type="text" name="respuesta_secreta3" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->respuesta_secreta3}}">
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Foto de Perfil:</label>
                <input class="form-control bg-dark" type="file" name="foto" id="formFile">
                <br>
                @if ($user->foto)
                    <img src="{{ Storage::url($user->foto) }}" alt="Sello actual del usuario" height="100" width="100">
                @endif
            </div>
            
            <button class="btn btn-lg btn-warning m-2">Actualizar</button>

        </form>
    </div>

@endsection