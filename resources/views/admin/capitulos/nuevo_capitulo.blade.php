@extends('layout.layout')

@section('title', 'Registro de Capítulos')

@section('content')

  <div class="bg-secondary rounded h-100 p-4">
      <h6 class="mb-4">Registrar Nuevo Capítulo</h6>
      <form method="POST" action="{{ route('registrar.capitulo') }}" enctype="multipart/form-data">
        
        @csrf

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">ID Capítulo:</label>
          <input type="text" name="capitulo_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Descripción:</label>
          <input type="text" name="descripcion" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>
          
          <button class="btn btn-lg btn-primary m-2">Registrar</button>
      </form>
  </div>
    
@endsection