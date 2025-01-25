@extends('layout.layout')

@section('title', 'Modificar Capítulo')

@section('content')

  <div class="bg-secondary rounded h-100 p-4">

      <h6 class="mb-4">Modificar Capítulo</h6>

      <form method="POST" action="{{ route('update.capitulos', $capitulo->id) }}" enctype="multipart/form-data">

          @csrf

          @method('PUT')

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">ID Capítulo:</label>
            <input type="text" value="{{$capitulo->capitulo_id}}" name="capitulo_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Descripción:</label>
            <input type="text" value="{{$capitulo->descripcion}}" name="descripcion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Estado:</label>
            <select name="activo" class="form-select mb-3" aria-label="Default select example">
              <option hidden selected>
                  @if ($capitulo->activo)
                      Activo
                  @else
                      Inactivo
                  @endif
              </option>
              <option value="1" {{ $capitulo->activo ? 'selected' : '' }}>Activo</option>
              <option value="0" {{ !$capitulo->activo ? 'selected' : '' }}>Inactivo</option>
            </select>
          </div>
          
          <button class="btn btn-lg btn-warning m-2">Actualizar</button>
      </form>
  </div>

@endsection