<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-14-76 | {{ config('app.name') }}</title>
    <style>
        {{ file_get_contents(public_path('assets/css/certificadoStyles.css')) }}
    </style>
    <link href="{{ public_path('assets/logo.png') }}" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('assets/logo.png') }}" alt="Logo IVSS">
            <p>REPÚBLICA BOLIVARIANA DE VENEZUELA</p>
            <p>MINISTERIO DEL PODER POPULAR PARA EL PROCESO SOCIAL DE TRABAJO</p>
            <p>INSTITUTO VENEZOLANO DE LOS SEGUROS SOCIALES</p>
            <p>DIRECCIÓN GENERAL DE AFILIACIÓN Y PRESTACIONES DE DINERO</p>
        </div>
        <div class="section">
            <h1>SOLICITUD DE PRORROGA DE PRESTACIONES</h1>
        </div>
        <div class="section">
            <table class="left-table">
                <tr>
                    <th>FECHA DE ELABORACIÓN:</th>
                    <th>N°:</th>
                </tr>
                <tr>
                    <td>{{ $fecha_elaboracion }}</td>
                    <td>{{ $prorroga->id }}</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <table>
                <tr>
                    <th>CENTRO ASISTENCIAL:</th>
                    <th>CONSULTA O SERVICIO:</th>
                </tr>
                <tr>
                    <td>{{ $usuario->centroAsistencial->nombre }}</td>
                    <td>{{ $usuario->servicio->nombre }}</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <table>
                <tr>
                    <th>CÉDULA DE IDENTIDAD:</th>
                    <th>APELLIDOS Y NOMBRES DEL (DE LA) ASEGURADO (A):</th>
                    <th>NACIMIENTO:</th>
                    <th>GÉNERO:</th>
                </tr>
                <tr>
                    <td>{{ $cedula_formateada }}</td>
                    <td>{{ $ciudadano->primer_nombre }} {{ $ciudadano->segundo_nombre }} {{ $ciudadano->primer_apellido }} {{ $ciudadano->segundo_apellido }}</td>
                    <td>{{ \Carbon\Carbon::parse($ciudadano->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <td>{{ $ciudadano->sexo }}</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <table>
                <tr>
                    <th>TELÉFONO HABITACIÓN:</th>
                    <th>TELÉFONO OFICINA</th>
                    <th>TELÉFONO MÓVIL</th>
                </tr>
                <tr>
                    <td>{{ $ciudadano->telefono_hab }}</td>
                    <td>02121234567</td>
                    <td>{{ $prorroga->telefono }}</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <table>
                <tr>
                    <th colspan="2">PERIODO DE REPOSO SOLICITADO</th>
                    <th>PRÓRROGA NÚMERO</th>
                </tr>
                <tr>
                    <th>DESDE</th>
                    <th>HASTA</th>
                    <td rowspan="2">{{ $expediente->cantidad_prorrogas }}</td>
                </tr>
                <tr>
                    <td>{{ \Carbon\Carbon::parse($prorroga->inicio_prorroga)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($prorroga->fin_prorroga)->format('d/m/Y') }}</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <table>
                <tr>
                    <th>DIAGNÓSTICO EN LETRAS</th>
                    <th>EVOLUCIÓN</th>
                </tr>
                <tr>
                    <td>{{ $prorroga->patologiaGeneral->descripcion }}</td>
                    <td rowspan="2">{{ $prorroga->evolucion }}</th>
                </tr>
                <tr>
                    <td>{{ $prorroga->patologiaEspecifica->descripcion }}</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <table>
                <tr>
                    <th colspan="3" rowspan="2">OBSERVACIONES</th>
                    <th colspan="4" rowspan="2">MÉDICO RESPONSABLE</th>
                    <th colspan="3">DIRECTOR(A) DEL CENTRO ASISTENCIAL</th>
                </tr>
                <tr>
                    <td colspan="3">(EN CASO DE INCAPACIDAD MAYOR A 21 DÍAS POR ENFERMEDAD O ACCIDENTES)</td>
                </tr>
                <tr>
                    <td colspan="3" rowspan="4">{{ $prorroga->observaciones }}</td>
                    <td colspan="4">{{ $usuario->nombres }} {{ $usuario->apellidos }}</td>
                    <td colspan="3">NOMBRES Y APELLIDOS</td>
                </tr>
                <tr>
                    <td colspan="3">CÉDULA DE IDENTIDAD</td>
                    <td>N° REGISTRO MPPS:</td>
                    <td colspan="3">CÉDULA DE IDENTIDAD</td>
                </tr>
                <tr>
                    <td colspan="3">{{ $usuario->cedula }}</td>
                    <td>{{ $usuario->nro_mpps }}</td>
                    <td colspan="3">98765432</td>
                </tr>
                <tr>
                    <td colspan="4"><br><br><br><br><br><br></td>
                    <td colspan="3"><br><br><br><br><br><br></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
