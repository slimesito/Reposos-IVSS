@extends('layout.layout')

@section('title', 'Registro de Usuarios')

@section('content')

  <div class="bg-secondary rounded h-100 p-4">
      <h6 class="mb-4">Registrar Nuevo Usuario</h6>
      <form method="POST" action="{{ route('registrar.usuario') }}" enctype="multipart/form-data">
        @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombres:</label>
            <input type="text" name="nombres" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apellidos:</label>
            <input type="text" name="apellidos" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Cédula:</label>
            <input type="text" name="cedula" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Correo Electrónico:</label>
            <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Número MPPS:</label>
            <input type="text" name="nro_mpps" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Cargo:</label>
            <select name="cod_cargo" placeholder="Seleccionar Tipo de Cargo" class="form-select mb-3" aria-label="Default select example">
              <option disabled hidden selected>Seleccione Tipo de Cargo</option>
              <option value="1">Analista</option>
              <option value="2">Comisión</option>
              <option value="3">Director</option>
              <option value="4">Master</option>
              <option value="5">Médico Especialista</option>
              <option value="6">Médico General</option>
              <option value="7">Suplente Especialista</option>
              <option value="8">Suplente General</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Teléfono:</label>
            <input type="text" name="telefono" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Teléfono Oficina:</label>
            <input type="text" name="telefono_oficina" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Servicio:</label>
            <select name="id_servicio" placeholder="Seleccione el Servicio" class="form-select mb-3" id="id_servicio" aria-label="Default select example">
                <option hidden selected disabled>Seleccione el Servicio</option>
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Centro Asistencial:</label>
            <select name="id_centro_asistencial" class="form-select mb-3" id="id_centro_asistencial" aria-label="Default select example">
                <option disabled hidden selected>Seleccione el Centro Asistencial</option>
                @foreach($centrosAsistenciales as $centroAsistencial)
                    <option value="{{ $centroAsistencial->id }}">{{ $centroAsistencial->nombre }}</option>
                @endforeach
            </select>
        </div>

          <div class="mb-3">
            <label for="formFile" class="form-label">Sello:</label>
            <input class="form-control bg-dark" type="file" name="sello" id="formFile">
          </div>

          <div class="mb-3">
            <label for="formFile" class="form-label">Firma:</label>
            <input class="form-control bg-dark" type="file" name="firma" id="formFile">
          </div>
          
          <button class="btn btn-lg btn-primary m-2">Registrar</button>
      </form>
  </div>
    
@endsection