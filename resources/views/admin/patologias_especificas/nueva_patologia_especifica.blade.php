@extends('layout.layout')

@section('title', 'Registro de Patología Específica')

@section('content')

  <div class="bg-secondary rounded h-100 p-4">

    <h6 class="mb-4">Registrar Nueva Patología Específica</h6>

    <form method="POST" action="{{ route('registrar.patologia-especifica') }}" enctype="multipart/form-data">
      
      @csrf

      <div class="mb-3">
        <label for="capitulo_id" class="form-label">Capítulo:</label>
        <select name="capitulo_id" class="form-select mb-3" id="capitulo_id" aria-label="Seleccione el Capítulo">
            <option hidden selected disabled>Seleccione el Capítulo</option>
            @foreach($capitulos as $capitulo)
                <option value="{{ $capitulo->id }}">{{ $capitulo->descripcion }}</option>
            @endforeach
        </select>
      </div>

      <div class="mb-3">
          <label for="id_pat_general" class="form-label">Patología General:</label>
          <select name="id_pat_general" class="form-select mb-3" id="id_pat_general" aria-label="Seleccione la Patología General" disabled>
              <option hidden selected disabled>Seleccione la Patología General</option>
          </select>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Código Patología Específica:</label>
        <input type="number" name="cod_pat_especifica" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">ID Patología Específica:</label>
        <input type="number" name="id_pat_especifica" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Descripción:</label>
        <input type="text" name="descripcion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Días de Reposo:</label>
        <input type="number" name="dias_reposo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>
        
      <button class="btn btn-lg btn-primary m-2">Registrar</button>

    </form>

  </div>
    
@endsection