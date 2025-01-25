@extends('layout.layout')

@section('title', 'Gestión de Capítulos')

@section('content')

    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Capítulos Registrados</h6>

        <form action="{{ route('buscador.capitulos') }}" method="GET" class="d-none d-md-flex ms-4">
            <input class="form-control bg-dark border-0" type="search" name="capitulosQuery" placeholder="Buscar Capítulos">
        </form>

        <br>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID Capítulo</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($capitulos as $capitulo)
                        <tr>
                            <td>{{ $capitulo->capitulo_id }}</td>
                            <td>{{ $capitulo->descripcion }}</td>
                            <td>
                                @if($capitulo->activo)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Botón para editar -->
                                    <form action="{{ route('editar.capitulos.view', $capitulo->id) }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="_method">
                                        <button type="submit" class="btn btn-warning">Editar</button>
                                    </form>
                                
                                    <!-- Botón para eliminar -->
                                    <form id="delete-form-Capítulo-{{ $capitulo->id }}" action="{{ route('destroy.capitulos', $capitulo->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $capitulo->id }}, 'Capítulo')">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $capitulos->links() }}
        </div>
    </div>

@endsection