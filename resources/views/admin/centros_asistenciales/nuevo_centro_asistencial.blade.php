@extends('layout.layout')

@section('title', 'Registro de Centro Asistencial')

@section('content')

  <div class="bg-secondary rounded h-100 p-4">

    <h6 class="mb-4">Registrar Nuevo Centro Asistencial</h6>

    <form method="POST" action="{{ route('registrar.centro-asistencial') }}" enctype="multipart/form-data">
      
      @csrf

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Código Centro:</label>
        <input type="number" name="cod_centro" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nombre:</label>
        <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Código Estado:</label>
        <input type="number" name="cod_estado" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">¿Es Hospital?:</label>
        <select name="es_hospital" placeholder="Seleccionar si Es Hospital" class="form-select mb-3" aria-label="Default select example">
          <option hidden selected>Seleccione</option>
          <option value="1">Sí</option>
          <option value="0">No</option>
      </select>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Código Tipo:</label>
        <input type="number" name="cod_tipo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Número de Reposo 1473:</label>
        <input type="number" name="nro_reposo_1473" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>

      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Rango de IP:</label>
        <input type="text" name="rango_ip" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
      </div>
        
      <button class="btn btn-lg btn-primary m-2">Registrar</button>

    </form>

  </div>
    
@endsection