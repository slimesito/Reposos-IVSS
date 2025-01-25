@extends('layout.layout')

@section('title', 'Resultados Búsqueda')

@section('content')
    
    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Patologías Generales Registradas</h6>

        <form action="{{ route('buscador.patologia-general') }}" method="GET" class="d-none d-md-flex ms-4">
            <input class="form-control bg-dark border-0" type="search" name="patologiaGeneralQuery" placeholder="Buscar Patología General">
        </form>

        <br>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID Patología General</th>
                    <th scope="col">ID Capítulo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Días Reposo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patologiasGenerales as $patologiaGeneral)
                    <tr>
                        <td>{{ $patologiaGeneral->pat_general_id }}</td>
                        <td>{{ $patologiaGeneral->capitulo_id }}</td>
                        <td>{{ $patologiaGeneral->descripcion }}</td>
                        <td>{{ $patologiaGeneral->dias_reposo }}</td>
                        <td>
                            @if($patologiaGeneral->activo)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <!-- Botón para editar -->
                                <form action="{{ route('editar.patologia-general.view', $patologiaGeneral->id) }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="_method">
                                    <button type="submit" class="btn btn-warning">Editar</button>
                                </form>
                            
                                <!-- Botón para eliminar -->
                                <form id="delete-form-Patología General-{{ $patologiaGeneral->id }}" action="{{ route('destroy.patologia-general', $patologiaGeneral->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $patologiaGeneral->id }}, 'Patología General')">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $patologiasGenerales->links() }}
    </div>

@endsection