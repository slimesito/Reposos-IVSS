@extends('layout.layout')

@section('title', 'Modificar Centro Asistencial')

@section('content')

  <div class="bg-secondary rounded h-100 p-4">

    <h6 class="mb-4">Modificar Centro Asistencial</h6>

    <form method="POST" action="{{ route('update.centro-asistencial', $centroAsistencial->id) }}" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Código Centro:</label>
          <input type="number" value="{{$centroAsistencial->cod_centro}}" name="cod_centro" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nombre:</label>
          <input type="text" value="{{$centroAsistencial->nombre}}" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Código Estado:</label>
          <input type="number" value="{{$centroAsistencial->cod_estado}}" name="cod_estado" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">¿Es Hospital?:</label>
          <select name="es_hospital" value="{{$centroAsistencial->es_hospital}}" placeholder="Seleccionar" class="form-select mb-3" aria-label="Default select example">
            <option hidden selected>{{$centroAsistencial->es_hospital}}</option>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Código Tipo:</label>
          <input type="number" value="{{$centroAsistencial->cod_tipo}}" name="cod_tipo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Rango de IP:</label>
          <input type="text" value="{{$centroAsistencial->rango_ip}}" name="rango_ip" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
        </div>

        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Estado:</label>
          <select name="activo" value="{{$centroAsistencial->activo}}" placeholder="Seleccionar estado del Centro Asistencial" class="form-select mb-3" aria-label="Default select example">
              <option hidden selected>{{$centroAsistencial->activo}}</option>
              <option value="1" {{ $centroAsistencial->activo ? 'selected' : '' }}>Activo</option>
              <option value="0" {{ !$centroAsistencial->activo ? 'selected' : '' }}>Inactivo</option>
          </select>
        </div>
        
        <button class="btn btn-lg btn-warning m-2">Actualizar</button>

    </form>

  </div>

@endsection