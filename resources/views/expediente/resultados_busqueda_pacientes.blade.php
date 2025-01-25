@extends('layout.layout')

@section('title', 'Resultados Búsqueda')

@section('content')

    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Pacientes Registrados</h6>

        <form action="{{ route('buscador.pacientes') }}" method="GET" class="d-none d-md-flex ms-4">
            <input class="form-control bg-dark border-0" type="search" name="pacientesQuery" placeholder="Buscar Pacientes">
        </form>

        <br>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Cantidad de Reposos</th>
                        <th>Cantidad de Prórrogas</th>
                        <th>Días Acumulados</th>
                        <th>Último Centro Asistencial</th>
                        <th>Último Reposo</th>
                        <th>Fecha de Creación</th>
                        <th>Fecha de Actualización</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expedientes as $expediente)
                        <tr>
                            <td>{{ $expediente->cedula }}</td>
                            <td>{{ $expediente->cantidad_reposos }}</td>
                            <td>{{ $expediente->cantidad_prorrogas }}</td>
                            <td>{{ $expediente->dias_acumulados }}</td>
                            <td>{{ $expediente->ultimoCentroAsistencial->nombre ?? 'N/A' }}</td>
                            <td>{{ $expediente->id_ultimo_reposo }}</td>
                            <td>{{ $expediente->fecha_create }}</td>
                            <td>{{ $expediente->fecha_update }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $expedientes->links() }}
        </div>
    </div>

@endsection