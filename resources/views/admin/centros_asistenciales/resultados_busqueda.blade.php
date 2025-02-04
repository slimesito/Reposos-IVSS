@extends('layout.layout')

@section('title', 'Gestión Centro Asistencial')

@section('content')

    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Centros Asistenciales Registrados</h6>

        <form action="{{ route('buscador.centro-asistencial') }}" method="GET" class="d-none d-md-flex ms-4">
            <input class="form-control bg-dark border-0" type="search" name="centroAsistencialQuery" placeholder="Buscar Centro Asistencial">
        </form>

        <br>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Hospital</th>
                        <th scope="col">Reposos</th>
                        <th scope="col">Rango IP</th>
                        <th scope="col">Activo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($centrosAsistenciales as $centroAsistencial)
                        <tr>
                            <td>{{ $centroAsistencial->cod_centro }}</td>
                            <td>{{ $centroAsistencial->nombre }}</td>
                            <td>{{ $centroAsistencial->cod_estado }}</td>
                            <td>
                                @if($centroAsistencial->es_hospital)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                            <td>{{ $centroAsistencial->nro_reposo_1473 }}</td>
                            <td>{{ $centroAsistencial->rango_ip }}</td>
                            <td>
                                @if($centroAsistencial->activo)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Botón para editar -->
                                    <form action="{{ route('editar.centro-asistencial.view', $centroAsistencial->id) }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="_method">
                                        <button type="submit" class="btn btn-warning rounded-pill m-2"><i class="fa-solid fa-pen-to-square" title="Editar"></i></button>
                                    </form>
                                
                                    <!-- Botón para eliminar -->
                                    <form id="delete-form-Centro Asistencial-{{ $centroAsistencial->id }}" action="{{ route('destroy.centro-asistencial', $centroAsistencial->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger rounded-pill m-2" onclick="confirmDelete({{ $centroAsistencial->id }}, 'Centro Asistencial')"><i class="fa-regular fa-trash-can" title="Eliminar"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $centrosAsistenciales->links() }}
        </div>
    </div>

@endsection