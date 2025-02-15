@extends('layout.layout')

@section('title', '14-76 Prórroga')

@section('content')

    <div class="bg-secondary rounded h-100 p-4">

        <h6 class="mb-4">Crear nueva Prórroga 14-76</h6>

        <form method="POST" action="{{ route('create.prorroga') }}" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label for="id_capitulo" class="form-label">Capítulo:</label>
                <select name="id_capitulo" class="form-select mb-3" id="id_capitulo" aria-label="Seleccione el Capítulo">
                    <option hidden selected disabled>Seleccione el Capítulo</option>
                    @foreach($capitulos as $capitulo)
                        <option value="{{ $capitulo->id }}">{{ $capitulo->descripcion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="id_pat_general" class="form-label">Patología General:</label>
                <select name="id_pat_general" class="form-select mb-3" id="id_pat_general" aria-label="Seleccione la Patología General" disabled>
                    <option hidden selected disabled>Seleccione la Patología General</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_pat_especifica" class="form-label">Patología Específica:</label>
                <select name="id_pat_especifica" class="form-select mb-3" id="id_pat_especifica" aria-label="Seleccione la Patología Específica" disabled>
                    <option hidden selected disabled>Seleccione la Patología Específica</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="inicio_prorroga" class="form-label">Inicio Prórroga:</label>
                <input type="date" name="inicio_prorroga" class="form-control" id="inicio_prorroga" required>
            </div>

            <div class="mb-3">
                <label for="fin_prorroga" class="form-label">Fin Prórroga:</label>
                <input type="date" name="fin_prorroga" class="form-control" id="fin_prorroga" required>
            </div>

            <div class="mb-3">
                <label for="evolucion" class="form-label">Evolución:</label>
                <input type="text" name="evolucion" class="form-control" id="evolucion">
            </div>

            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones:</label>
                <input type="text" name="observaciones" class="form-control" id="observaciones">
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="number" name="telefono" class="form-control" id="telefono">
            </div>

            <button class="btn btn-lg btn-primary m-2">Registrar</button>

        </form>

    </div>

@endsection