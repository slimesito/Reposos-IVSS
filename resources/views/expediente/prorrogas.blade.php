@extends('layout.layout')

@section('title', 'Prorrogas')

@section('content')

    <div class="bg-secondary rounded h-100 p-4">
        <h6 class="mb-4">Prorrogas Registradas</h6>

        <form action="{{ route('buscador.prorrogas') }}" method="GET" class="d-none d-md-flex ms-4">
            <input class="form-control bg-dark border-0" type="search" name="prorrogasQuery" placeholder="Buscar Prorrogas">
        </form>

        <br>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Especialidad</th>
                        <th>Capítulo</th>
                        <th>Patología General</th>
                        <!-- <th>Patología Específica</th> -->
                        <th>Fecha</th>
                        <th>PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prorrogas as $prorroga)
                        <tr>
                            <td>{{ $prorroga->cedula_formateada }}</td>
                            <td>{{ $prorroga->servicio->nombre }}</td>
                            <td>{{ $prorroga->capitulo->capitulo_id }}</td>
                            <td>{{ $prorroga->patologiaGeneral->descripcion }}</td>
                            <!-- <td>{{ $prorroga->patologiaEspecifica->descripcion ?? 'N/A' }}</td> -->
                            <td>{{ \Carbon\Carbon::parse($prorroga->fecha_create)->format('d/m/Y h:i A') }}</td>
                            <td>
                                <a href="{{ route('descargar.prorroga.pdf', $prorroga->id) }}" class="btn btn-danger rounded-pill m-2" title="Descargar en PDF"><i class="fa-solid fa-download"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $prorrogas->links() }}
        </div>
    </div>

@endsection