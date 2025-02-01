@extends('layout.layout')

@section('title', 'Gestión de Usuarios')

@section('content')

    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Usuarios Registrados</h6>

        <form action="{{ route('buscador.usuarios') }}" method="GET" class="d-none d-md-flex ms-4">
            <input class="form-control bg-dark border-0" type="search" name="usuariosQuery" placeholder="Buscar">
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Cédula</th>
                        {{-- <th scope="col">Correo Electrónico</th> --}}
                        <th scope="col">Número MPPS</th>
                        {{-- <th scope="col">Cargo</th> --}}
                        {{-- <th scope="col">Teléfono</th>
                        <th scope="col">Teléfono Oficina</th> --}}
                        <th scope="col">Servicio</th>
                        <th scope="col">C. Asistencial</th>
                        <th scope="col">Estado</th>
                        {{-- <th scope="col">Foto</th> --}}
                        <th scope="col">Sello</th>
                        <th scope="col">Firma</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->nombres }}</td>
                            <td>{{ $user->apellidos }}</td>
                            <td>{{ $user->cedula }}</td>
                            {{-- <td>{{ $user->email }}</td> --}}
                            <td>{{ $user->nro_mpps }}</td>
                            {{-- <td>{{ $user->cod_cargo }}</td> --}}
                            {{-- <td>{{ $user->telefono }}</td>
                            <td>{{ $user->telefono_oficina }}</td> --}}
                            <td>{{ $user->servicio ? $user->servicio->nombre : 'N/A' }}</td>
                            <td>{{ $user->centroAsistencial ? $user->centroAsistencial->nombre : 'N/A' }}</td>
                            <td>
                                @if($user->activo)
                                    Activo
                                @else
                                    Inactivo
                                @endif
                            </td>
                            {{-- <td>
                                @if($user->foto)
                                    <img src="{{ Storage::url($user->foto) }}" alt="Foto del usuario" height="50" width="50">
                                @else
                                    Sin foto
                                @endif
                            </td> --}}
                            <td>
                                @if($user->sello)
                                    <img src="{{ Storage::url($user->sello) }}" alt="Sello del usuario" height="50" width="50">
                                @else
                                    Sin sello
                                @endif
                            </td>
                            <td>
                                @if($user->firma)
                                    <img src="{{ Storage::url($user->firma) }}" alt="Firma del usuario" height="50" width="50">
                                @else
                                    Sin firma
                                @endif  
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Botón para editar -->
                                    <form action="{{ route('editar.usuarios.view', $user->id) }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="_method">
                                        <button type="submit" class="btn btn-warning rounded-pill m-1">Editar</button>
                                    </form>
                                
                                    <!-- Botón para eliminar -->

                                    <form id="delete-form-Usuario-{{ $user->id }}" action="{{ route('usuarios.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger rounded-pill m-1" onclick="confirmDelete({{ $user->id }}, 'Usuario')">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>

@endsection