@extends('layout.layout')

@section('title', 'Gestión de Servicios')

@section('content')

    @include('layout.alerts.success-message')

    @include('layout.alerts.reposos-success')

    @include('layout.alerts.error-message')

    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Servicios Registrados</h6>

        <form action="{{ route('buscador.servicios') }}" method="GET" class="d-none d-md-flex ms-4">
            <input class="form-control bg-dark border-0" type="search" name="serviciosQuery" placeholder="Buscar Servicios">
        </form>

        <br>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tiempo Cita</th>
                        <th scope="col">¿Autoriza Maternidad?</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios as $servicio)
                        <tr>
                            <td>{{ $servicio->cod_servicio }}</td>
                            <td>{{ $servicio->nombre }}</td>
                            <td>{{ $servicio->tiempo_cita }}</td>
                            <td>
                                @if($servicio->autoriza_maternidad)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                            <td>
                                @if($servicio->activo)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Botón para editar -->
                                    <form action="{{ route('editar.servicio.view', $servicio->id) }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="_method">
                                        <button type="submit" class="btn btn-warning rounded-pill m-2"><i class="fa-solid fa-pen-to-square" title="Editar"></i></button>
                                    </form>
                                
                                    <!-- Botón para eliminar -->
                                    <form id="delete-form-Servicio-{{ $servicio->id }}" action="{{ route('destroy.servicio', $servicio->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger rounded-pill m-2" onclick="confirmDelete({{ $servicio->id }}, 'Servicio')"><i class="fa-regular fa-trash-can" title="Eliminar"></i></button>
                                    </form>
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $servicios->links() }}
        </div>
    </div>

@endsection