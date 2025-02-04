@extends('layout.layout')

@section('title', 'Gestión Patología General')

@section('content')

    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Patologías Generales Registradas</h6>

        <form action="{{ route('buscador.patologia-general') }}" method="GET" class="d-none d-md-flex ms-4">
            <input class="form-control bg-dark border-0" type="search" name="patologiaGeneralQuery" placeholder="Buscar Patología General">
        </form>

        <br>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Patología General</th>
                        <th scope="col">Capítulo</th>
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
                            <td>{{ $patologiaGeneral->capitulo->capitulo_id }}</td>
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
                                        <button type="submit" class="btn btn-warning rounded-pill m-2"><i class="fa-solid fa-pen-to-square" title="Editar"></i></button>
                                    </form>
                                
                                    <!-- Botón para eliminar -->
                                    <form id="delete-form-Patología General-{{ $patologiaGeneral->id }}" action="{{ route('destroy.patologia-general', $patologiaGeneral->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger rounded-pill m-2" onclick="confirmDelete({{ $patologiaGeneral->id }}, 'Patología General')"><i class="fa-regular fa-trash-can" title="Eliminar"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $patologiasGenerales->links() }}
        </div>
    </div>

@endsection