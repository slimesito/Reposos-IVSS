@extends('layout.layout')

@section('title', 'Registro de Patología General')

@section('content')

  <div class="bg-secondary rounded h-100 p-4">

    <h6 class="mb-4">Registrar Nueva Patología General</h6>

    <form method="POST" action="{{ route('registrar.patologia-general') }}" enctype="multipart/form-data">
      
      @csrf

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">ID Patología General:</label>
        <input type="text" name="pat_general_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>

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