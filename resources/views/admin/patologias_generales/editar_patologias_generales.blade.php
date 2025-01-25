@extends('layout.layout')

@section('title', 'Modificar Patología General')

@section('content')

  <div class="bg-secondary rounded h-100 p-4">

    <h6 class="mb-4">Modificar Patología General</h6>

    <form method="POST" action="{{ route('update.patologia-general', $patologiaGeneral->id) }}" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">ID Patología General:</label>
          <input type="text" value="{{$patologiaGeneral->pat_general_id}}" name="pat_general_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">ID Capítulo:</label>
          <input type="number" value="{{$patologiaGeneral->capitulo_id}}" name="capitulo_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Descripción:</label>
          <input type="text" value="{{$patologiaGeneral->descripcion}}" name="descripcion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Días de Reposo:</label>
          <input type="number" value="{{$patologiaGeneral->dias_reposo}}" name="dias_reposo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Estado:</label>
          <select name="activo" class="form-select mb-3" aria-label="Default select example">
            <option hidden selected>
                @if ($patologiaGeneral->activo)
                    Activo
                @else
                    Inactivo
                @endif
            </option>
            <option value="1" {{ $patologiaGeneral->activo ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ !$patologiaGeneral->activo ? 'selected' : '' }}>Inactivo</option>
          </select>
        </div>
        
        <button class="btn btn-lg btn-warning m-2">Actualizar</button>

    </form>

  </div>

@endsection