@extends('layout.layout')

@section('title', 'Gestión Patología Específica')

@section('content')

    @include('layout.alerts.success-message')

    @include('layout.alerts.reposos-success')

    @include('layout.alerts.error-message')

    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Patologías Específicas Registradas</h6>

        <form action="{{ route('buscador.patologia-especifica') }}" method="GET" class="d-none d-md-flex ms-4">
            <input class="form-control bg-dark border-0" type="search" name="patologiaEspecificaQuery" placeholder="Buscar Patología Específica">
        </form>

        <br>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Capítulo</th>
                        <th scope="col">Patología General</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Días Reposo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patologiasEspecificas as $patologiaEspecifica)
                        <tr>
                            <td>{{ $patologiaEspecifica->capitulo->capitulo_id }}</td>
                            <td>{{ $patologiaEspecifica->patologiaGeneral->pat_general_id }}</td>
                            <td>{{ $patologiaEspecifica->descripcion }}</td>
                            <td>{{ $patologiaEspecifica->dias_reposo }}</td>
                            <td>
                                @if($patologiaEspecifica->activo)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Botón para editar -->
                                    <form action="{{ route('editar.patologia-especifica.view', $patologiaEspecifica->id) }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="_method">
                                        <button type="submit" class="btn btn-warning rounded-pill m-2"><i class="fa-solid fa-pen-to-square" title="Editar"></i></button>
                                    </form>
                                
                                    <!-- Botón para eliminar -->
                                    <form id="delete-form-Patología Específica-{{ $patologiaEspecifica->id }}" action="{{ route('destroy.patologia-especifica', $patologiaEspecifica->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger rounded-pill m-2" onclick="confirmDelete({{ $patologiaEspecifica->id }}, 'Patología Específica')"><i class="fa-regular fa-trash-can" title="Eliminar"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $patologiasEspecificas->links() }}
        </div>
    </div>

@endsection