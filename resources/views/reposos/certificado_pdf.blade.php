<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F-14-73 | {{ config('app.name') }}</title>
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
            <h1>CERTIFICADO DE INCAPACIDAD TEMPORAL</h1>
        </div>
        <div class="section">
            <table class="left-table">
                <tr>
                    <th>FECHA DE ELABORACIÓN:</th>
                    <th>N°:</th>
                </tr>
                <tr>
                    <td>{{ $fecha_elaboracion }}</td>
                    <td>{{ $reposo->id }}</td>
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
                    <td>{{ $reposo->cedula }}</td>
                    <td>{{ $ciudadano->primer_nombre }} {{ $ciudadano->segundo_nombre }} {{ $ciudadano->primer_apellido }} {{ $ciudadano->segundo_apellido }}</td>
                    <td>{{ \Carbon\Carbon::parse($ciudadano->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <td>{{ $ciudadano->sexo }}</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <table>
                <tr>
                    <th colspan="3">NÚMERO TELEFÓNICO DEL ASEGURADO(A):</th>
                    <th colspan="3">CORREO EMPLEADO:</th>
                    <th>CORREO JEFE INMEDIATO:</th>
                    <th>CORREO EMPLEADOR:</th>
                    <th>CÓDIGO:</th>
                    <th>FECHA REINTEGRO:</th>
                </tr>
                <tr>
                    <th>HABITACIÓN:</th>
                    <th>OFICINA</th>
                    <th>MÓVIL</th>
                    <td rowspan="2" colspan="3">{{ $reposo->email_trabajador }}</td>
                    <td rowspan="2">CORREO@JEFE.COM</td>
                    <td rowspan="2">CORREO@EMPLEADOR.COM</td>
                    <td rowspan="2">123</td>
                    <td rowspan="2">{{ \Carbon\Carbon::parse($reposo->reintegro)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td>{{ $ciudadano->telefono_hab }}</td>
                    <td>02121234567</td>
                    <td>{{ $ciudadano->telefono_movil }}</td>
                </tr>
                <tr>
                    <th>INCAPACIDAD POR:</th>
                    <th colspan="3">CONCEPTO</th>
                    <th colspan="3">PERIODO DE INCAPACIDAD</th>
                    <th>PRE-NATAL</th>
                    <th>POST-NATAL</th>
                    <th>DEBE VOLVER</th>
                </tr>
                <tr>
                    <th>AMBULATORIA</th>
                    <th>E</th>
                    <th>M</th>
                    <th>A</th>
                    <th>DESDE</th>
                    <th>HASTA</th>
                    <th>NÚMERO DE DÍAS</th>
                    <td rowspan="2">{{ $reposo->es_prenatal ? 'SÍ' : 'NO' }}</td>
                    <td rowspan="2">{{ $reposo->es_postnatal ? 'SÍ' : 'NO' }}</td>
                    <td rowspan="2">{{ $reposo->debe_volver ? 'SÍ' : 'NO' }}</td>
                </tr>
                <tr>
                    <th>HOSPITALIZACIÓN</th>
                    <td>X</td>
                    <td>X</td>
                    <td>X</td>
                    <td>{{ \Carbon\Carbon::parse($reposo->inicio_reposo)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reposo->fin_reposo)->format('d/m/Y') }}</td>
                    <td>{{ $reposo->dias_indemnizar }}</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <table>
                <tr>
                    <th>CITA NÚMERO</th>
                    <th colspan="9">DIAGNÓSTICO EN LETRAS</th>
                    <th>CONVALIDADO</th>
                    <th>CÓDIGO DIAGNÓSTICO</th>
                </tr>
                <tr>
                    <td rowspan="2">{{ $expediente->cantidad_reposos }}</td>
                    <td colspan="9">{{ $reposo->patologiaGeneral->descripcion }}</td>
                    <td rowspan="2">{{ $reposo->convalidado ? 'SÍ' : 'NO' }}</td>
                    <td rowspan="2">123</td>
                </tr>
                <tr>
                    <td colspan="9">{{ $reposo->patologiaEspecifica->descripcion }}</td>
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
                    <td colspan="3" rowspan="4">{{ $reposo->observaciones }}</td>
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
