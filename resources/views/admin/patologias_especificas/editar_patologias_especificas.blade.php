@extends('layout.layout')

@section('title', 'Modificar Patología Específica')

@section('content')

  <div class="bg-secondary rounded h-100 p-4">

    <h6 class="mb-4">Modificar Patología Específica</h6>

    <form method="POST" action="{{ route('update.patologia-especifica', $patologiaEspecifica->id) }}" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="mb-3">
          <label for="capitulo_id" class="form-label">Capítulo:</label>
          <select name="capitulo_id" class="form-select mb-3" id="capitulo_id">
            <option hidden selected value="{{ $patologiaEspecifica->capitulo_id }}">{{ $patologiaEspecifica->capitulo->descripcion }}</option>
            @foreach($capitulos as $capitulo)
                <option value="{{ $capitulo->id }}">{{ $capitulo->descripcion }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="capitulo_id" class="form-label">Patología General:</label>
          <select name="id_pat_general" class="form-select mb-3" id="id_pat_general">
            <option hidden selected value="{{ $patologiaEspecifica->id_pat_general }}">{{ $patologiaEspecifica->patologiaGeneral->descripcion }}</option>
            @foreach($patologiasGenerales as $patologiaGeneral)
              <option value="{{ $patologiaGeneral->id }}">{{ $patologiaGeneral->descripcion }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Código Patología Específica:</label>
          <input type="number" value="{{$patologiaEspecifica->cod_pat_especifica}}" name="cod_pat_especifica" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">ID Patología Específica:</label>
          <input type="number" value="{{$patologiaEspecifica->id_pat_especifica}}" name="id_pat_especifica" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Descripción:</label>
          <input type="text" value="{{$patologiaEspecifica->descripcion}}" name="descripcion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Días de Reposo:</label>
          <input type="number" value="{{$patologiaEspecifica->dias_reposo}}" name="dias_reposo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Estado:</label>
          <select name="activo" class="form-select mb-3" aria-label="Default select example">
            <option hidden selected>
                @if ($patologiaEspecifica->activo)
                    Activo
                @else
                    Inactivo
                @endif
            </option>
            <option value="1" {{ $patologiaEspecifica->activo ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ !$patologiaEspecifica->activo ? 'selected' : '' }}>Inactivo</option>
          </select>
        </div>
        
        <button class="btn btn-lg btn-warning m-2">Actualizar</button>

    </form>

  </div>

@endsection