@extends('layout.layout')

@section('title', 'Gestión Reposos')

@section('content')

    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Reposos Pendientes</h6>

        {{-- <form action="{{ route('buscador.reposos.pendientes') }}" method="GET" class="d-none d-md-flex ms-4">
            <input class="form-control bg-dark border-0" type="search" name="capitulosQuery" placeholder="Buscar Reposos">
        </form> --}}

        <br>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Cédula</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Capítulo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reposos as $reposo)
                        <tr>
                            <td>{{ $reposo->cedula }}</td>
                            <td>{{ $reposo->servicio->nombre ?? 'N/A' }}</td>
                            <td>{{ $reposo->capitulo->descripcion ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($reposo->fecha_create)->format('d-m-Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Botón para aprobar -->
                                    <form action="{{ route('aprobar.reposo', $reposo->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning rounded-pill m-2">Aprobar</button>
                                    </form>
                            
                                    <!-- Botón para rechazar -->
                                    <button type="button" class="btn btn-danger rounded-pill m-2" onclick="confirmReject('{{ $reposo->id }}', 'reposo')">Rechazar</button>
                            
                                    <!-- Formulario oculto para rechazar -->
                                    <form id="reject-form-reposo-{{ $reposo->id }}" action="{{ route('rechazar.reposo', $reposo->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PATCH')
                                    </form>
                                </div>
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $reposos->links() }}
        </div>
        
        
    </div>
    
@endsection