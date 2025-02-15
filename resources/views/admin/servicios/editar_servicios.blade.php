@extends('layout.layout')

@section('title', 'Modificar Servicio')

@section('content')
  @include('layout.alerts.success-message')

  @include('layout.alerts.reposos-success')

  @include('layout.alerts.error-message')

  <div class="bg-secondary rounded h-100 p-4">

      <h6 class="mb-4">Modificar Servicio</h6>

      <form method="POST" action="{{ route('update.servicio', $servicio->id) }}" enctype="multipart/form-data">

          @csrf

          @method('PUT')

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Código de Servicio:</label>
            <input type="number" value="{{$servicio->cod_servicio}}" name="cod_servicio" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre:</label>
            <input type="text" value="{{$servicio->nombre}}" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tiempo de Cita:</label>
            <input type="number" value="{{$servicio->tiempo_cita}}" name="tiempo_cita" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">¿Autoriza Maternidad?:</label>
            <select name="autoriza_maternidad" class="form-select mb-3" aria-label="Default select example">
                <option hidden selected>
                  @if ($servicio->autoriza_maternidad)
                      Sí
                  @else
                      No
                  @endif
              </option>
                <option value="1" {{ $servicio->autoriza_maternidad ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ !$servicio->autoriza_maternidad ? 'selected' : '' }}>No</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Estado:</label>
            <select name="activo" class="form-select mb-3" aria-label="Default select example">
              <option hidden selected>
                  @if ($servicio->activo)
                      Activo
                  @else
                      Inactivo
                  @endif
              </option>
              <option value="1" {{ $servicio->activo ? 'selected' : '' }}>Activo</option>
              <option value="0" {{ !$servicio->activo ? 'selected' : '' }}>Inactivo</option>
            </select>
          </div>
          
          <button class="btn btn-lg btn-warning m-2">Actualizar</button>
      </form>
  </div>

@endsection