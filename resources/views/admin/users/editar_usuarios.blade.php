@extends('layout.layout')

@section('title', 'Modificar Usuarios')

@section('content')

  <div class="bg-secondary rounded h-100 p-4">

      <h6 class="mb-4">Modificar Usuario</h6>

      <form method="POST" action="{{ route('usuarios.update', $user->id) }}" enctype="multipart/form-data">

          @csrf

          @method('PUT')
          
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombres:</label>
            <input type="text" value="{{$user->nombres}}" name="nombres" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apellidos:</label>
            <input type="text" value="{{$user->apellidos}}" name="apellidos" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Correo Electrónico:</label>
            <input type="text" value="{{$user->email}}" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Número MPPS:</label>
            <input type="text" value="{{$user->nro_mpps}}" name="nro_mpps" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Cargo:</label>
            <select name="cod_cargo" value="{{$user->cod_cargo}}" placeholder="Seleccionar Tipo de Cargo" class="form-select mb-3" aria-label="Default select example">
              <option hidden selected>{{$user->cod_cargo}}</option>
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
            <input type="text" value="{{$user->telefono}}" name="telefono" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Teléfono Oficina:</label>
            <input type="text" value="{{$user->telefono_oficina}}" name="telefono_oficina" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="id_servicio" class="form-label">Servicio</label>
            <select name="id_servicio" class="form-select" id="id_servicio" required>
                <option disabled hidden>Seleccione el Servicio</option>
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id }}" {{ $user->id_servicio == $servicio->id ? 'selected' : '' }}>{{ $servicio->nombre }}</option>
                @endforeach
            </select>
          </div>
        
          <div class="mb-3">
              <label for="id_centro_asistencial" class="form-label">Centro Asistencial</label>
              <select name="id_centro_asistencial" class="form-select" id="id_centro_asistencial" required>
                  <option disabled hidden>Seleccione el Centro Asistencial</option>
                  @foreach($centrosAsistenciales as $centroAsistencial)
                      <option value="{{ $centroAsistencial->id }}" {{ $user->id_centro_asistencial == $centroAsistencial->id ? 'selected' : '' }}>{{ $centroAsistencial->nombre }}</option>
                  @endforeach
              </select>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Estado:</label>
            <select name="activo" class="form-select mb-3" aria-label="Default select example">
              <option hidden selected>
                  @if ($user->activo)
                      Activo
                  @else
                      Inactivo
                  @endif
              </option>
              <option value="1" {{ $user->activo ? 'selected' : '' }}>Activo</option>
              <option value="0" {{ !$user->activo ? 'selected' : '' }}>Inactivo</option>
            </select>
          </div>

          <div class="mb-3">
              <label for="formFile" class="form-label">Sello:</label>
              <input class="form-control bg-dark" type="file" name="sello" id="formFile">
              <br>
              @if ($user->sello)
                  <img src="{{ Storage::url($user->sello) }}" alt="Sello actual del usuario" height="100" width="100">
              @endif
          </div>

          <div class="mb-3">
              <label for="formFile" class="form-label">Firma:</label>
              <input class="form-control bg-dark" type="file" name="firma" id="formFile">
              <br>
              @if ($user->firma)
                  <img src="{{ Storage::url($user->firma) }}" alt="Firma actual del usuario" height="100" width="100">
              @endif
          </div>
          
          <button class="btn btn-lg btn-warning m-2">Actualizar</button>
      </form>
  </div>

@endsection