@extends('layout.layout')

@section('title', '14-73 Maternidad')

@section('content')

    <div class="bg-secondary rounded h-100 p-4">

        <h6 class="mb-4">Crear nuevo Reposo 14-73</h6>

        <form method="POST" action="{{ route('create.reposo.maternidad') }}" enctype="multipart/form-data">

            @csrf

            {{-- <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Capítulo:</label>
                
                <select name="id_capitulo" placeholder="Seleccione el Capítulo" class="form-select mb-3" id="id_capitulo" aria-label="Default select example">
                    
                    <option hidden selected disabled>Seleccione el Capítulo</option>
                    @foreach($capitulos as $capitulo)
                        <option value="{{ $capitulo->id }}">{{ $capitulo->descripcion }}</option>
                    @endforeach

                </select>

        
            </div> --}}

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Patología General:</label>
                
                <select name="id_pat_general" placeholder="Seleccione la Patología General" class="form-select mb-3" id="id_pat_general" aria-label="Default select example">
                    
                    <option hidden selected disabled>Seleccione la Patología General</option>
                    @foreach($patologiasGenerales as $patologiaGeneral)
                        <option value="{{ $patologiaGeneral->id }}">{{ $patologiaGeneral->descripcion }}</option>
                    @endforeach

                </select>

        
            </div>

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Patología Específica:</label>
                
                <select name="id_pat_especifica" placeholder="Seleccione la Patología Específica" class="form-select mb-3" id="id_pat_especifica" aria-label="Default select example">
                    
                    <option hidden selected disabled>Seleccione la Patología Específica</option>
                    @foreach($patologiasEspecificas as $patologiaEspecifica)
                        <option value="{{ $patologiaEspecifica->id }}">{{ $patologiaEspecifica->descripcion }}</option>
                    @endforeach

                </select>

        
            </div>

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Lugar:</label>
                
                <select name="id_lugar" placeholder="Seleccione el Lugar" class="form-select mb-3" id="id_lugar" aria-label="Default select example">
                    
                    <option hidden selected disabled>Seleccione el Lugar</option>
                    @foreach($lugares as $lugar)
                        <option value="{{ $lugar->cod_lugar }}">{{ $lugar->descripcion }}</option>
                    @endforeach

                </select>

        
            </div>

            <div class="mb-3">

                <label for="exampleInputEmail1" class="form-label">Motivo:</label>
                
                <select name="cod_motivo" placeholder="Seleccione el Motivo" class="form-select mb-3" id="cod_motivo" aria-label="Default select example">
                    
                    <option hidden selected disabled>Seleccione el Motivo</option>
                    @foreach($motivos as $motivo)
                        <option value="{{ $motivo->cod_motivo }}">{{ $motivo->descripcion }}</option>
                    @endforeach

                </select>

        
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Inicio del Reposo:</label>
                <input type="date" name="inicio_reposo" class="form-control" id="inicio_reposo" aria-describedby="emailHelp" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fin del Reposo:</label>
                <input type="date" name="fin_reposo" class="form-control" id="fin_reposo" aria-describedby="emailHelp" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Reintegro:</label>
                <input type="date" name="reintegro" class="form-control" id="reintegro" aria-describedby="emailHelp" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">¿Debe volver?:</label>
                <select name="debe_volver" placeholder="Seleccione:" class="form-select mb-3" aria-label="Default select example">
                    <option disabled hidden selected>Seleccione:</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">¿Es Pre-Natal?:</label>
                <select name="es_prenatal" class="form-select mb-3" aria-label="Default select example">
                    <option disabled hidden selected>Seleccione:</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">¿Es Post-Natal?:</label>
                <select name="es_postnatal" class="form-select mb-3" aria-label="Default select example">
                    <option disabled hidden selected>Seleccione:</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo Electrónico del Trabajador:</label>
                <input type="text" name="email_trabajador" class="form-control" id="email_trabajador" aria-describedby="emailHelp" required>
            </div>
            
            <button class="btn btn-lg btn-primary m-2">Registrar</button>

        </form>

    </div>
    
@endsection