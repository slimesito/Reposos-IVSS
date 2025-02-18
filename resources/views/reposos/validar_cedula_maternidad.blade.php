@extends('layout.layout')

@section('title', 'Validar cédula')

@section('content')

    @include('layout.alerts.success-message')

    @include('layout.alerts.reposos-success')

    @include('layout.alerts.error-message')

    <div class="bg-secondary rounded h-100 p-4">

        <h6 class="mb-4">Validar Cédula de Identidad de la Paciente</h6>

        <form action="{{ route('validar.cedula.reposo.maternidad') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label for="nacionalidad" class="form-label">Nacionalidad:</label>
                
                <select id="nacionalidad" name="nacionalidad" class="form-select mb-3" aria-label="Default select example" required>
                    <option hidden selected>Seleccionar Nacionalidad</option>
                    <option value="1">Venezolana</option>
                    <option value="2">Extranjera</option>
                </select>

            </div>

            <div class="mb-3">

                <label for="cedula" class="form-label">Cédula de Identidad:</label>
                <input type="number" id="cedula" name="cedula" class="form-control" required>

            </div>

            <button type="submit" class="btn btn-primary">Buscar</button>

        </form>

    </div>

@endsection