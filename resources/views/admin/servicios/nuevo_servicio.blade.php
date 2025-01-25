@extends('layout.layout')

@section('title', 'Registro de Servicios')

@section('content')

  <div class="bg-secondary rounded h-100 p-4">
      <h6 class="mb-4">Registrar Nuevo Servicio</h6>
      <form method="POST" action="{{ route('create.servicio') }}" enctype="multipart/form-data">
        
        @csrf

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Código de Servicio:</label>
          <input type="number" name="cod_servicio" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nombre:</label>
          <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Tiempo de Cita:</label>
          <input type="number" name="tiempo_cita" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">¿Autoriza Maternidad?:</label>
          <select name="autoriza_maternidad" class="form-select mb-3" aria-label="Default select example">
              <option hidden selected disabled>Seleccionar</option>
              <option value="1">Sí</option>
              <option value="0">No</option>
          </select>
        </div>
          
        <button class="btn btn-lg btn-primary m-2">Registrar</button>

      </form>
  </div>
    
@endsection