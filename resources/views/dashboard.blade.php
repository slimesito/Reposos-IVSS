@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')

    <div class="col-sm-12 col-xl-12">

        @include('layout.alerts.success-message')

        @include('layout.alerts.reposos-success')

        @include('layout.alerts.error-message')

        @if (Auth::check() && Auth::user()->cod_cargo == 4)

            <div class="bg-secondary rounded h-100 p-4">
                <h1 class="display-6 mb-0">Estadísticas Reposos-IVSS</h1>
            </div>

    </div>

    <div class="col-sm-12 col-xl-6">
    
            <!-- Gráfico de barras (expedientes por mes) -->
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Pacientes por Mes</h6>
                <canvas id="expedientes-chart"></canvas>
            </div>

    </div>

    <div class="col-sm-12 col-xl-6">

            <!-- Gráfico de pie (reposos por tipo y prórrogas) -->
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Reposos por Tipo y Prórrogas</h6>
                <canvas id="pie-chart"></canvas>
            </div>

    </div>

    <div class="col-sm-12 col-xl-12">

            <!-- Gráfico de barras (reposos por estado) -->
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Reposos por Estado</h6>
                <canvas id="bar-chart"></canvas>
            </div>

    </div>

    <script>

            // Datos para el gráfico de barras (expedientes por mes)
            var expedientesLabels = @json($expedientesLabels); // Meses (en formato YYYY-MM)
            var expedientesData = @json($expedientesData); // Cantidad de expedientes por mes

            // Configuración del gráfico de barras (expedientes por mes)
            var ctxExpedientes = document.getElementById('expedientes-chart').getContext('2d');
            var expedientesChart = new Chart(ctxExpedientes, {
                type: "bar",
                data: {
                    labels: expedientesLabels,
                    datasets: [{
                        label: "Pacientes por Mes",
                        data: expedientesData,
                        backgroundColor: "rgba(235, 22, 22, .7)",
                        borderColor: "rgba(235, 22, 22, .3)",
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Datos para el gráfico de pie (reposos por tipo y prórrogas)
            var enfermedadCount = {{ $enfermedadCount }};
            var prenatalCount = {{ $prenatalCount }};
            var postnatalCount = {{ $postnatalCount }};
            var prorrogasCount = {{ $prorrogasCount }};

            // Configuración del gráfico de pie
            var ctxPie = document.getElementById('pie-chart').getContext('2d');
            var pieChart = new Chart(ctxPie, {
                type: "pie",
                data: {
                    labels: ["Enfermedad", "Prenatal", "Postnatal", "Prórrogas"],
                    datasets: [{
                        data: [enfermedadCount, prenatalCount, postnatalCount, prorrogasCount],
                        backgroundColor: [
                            "rgba(235, 22, 22, .7)", // Color para Enfermedad
                            "rgba(235, 22, 22, .6)", // Color para Prenatal
                            "rgba(235, 22, 22, .5)", // Color para Postnatal
                            "rgba(235, 22, 22, .4)"  // Color para Prórrogas
                        ],
                        borderColor: "rgba(255, 255, 255, 1)",
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true
                }
            });

            // Datos para el gráfico de barras
            var labels = @json($labels); // Nombres de los estados
            var data = @json($data); // Cantidad de reposos por estado

            // Configuración del gráfico de barras
            var ctxBar = document.getElementById('bar-chart').getContext('2d');
            var barChart = new Chart(ctxBar, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Reposos por Estado",
                        data: data,
                        backgroundColor: [
                            "rgba(235, 22, 22, .7)",
                            "rgba(235, 22, 22, .6)",
                            "rgba(235, 22, 22, .5)",
                            "rgba(235, 22, 22, .4)",
                            "rgba(235, 22, 22, .3)"
                        ],
                        borderColor: "rgba(235, 22, 22, 1)",
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

    </script>

        @endif

@endsection