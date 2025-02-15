<?php

namespace App\Http\Controllers\Reposos;

use App\Http\Controllers\Controller;
use App\Models\AseguradoEmpresa;
use App\Models\Capitulo;
use App\Models\Ciudadano;
use App\Models\Expediente;
use App\Models\Forma_14144;
use App\Models\Lugar;
use App\Models\Motivo;
use App\Models\PatologiaEspecifica;
use App\Models\PatologiaGeneral;
use App\Models\Reposo;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RepososMaternidadController extends Controller
{
    public function validarCedulaReposoMaternidadView()
    {
        return view('reposos.validar_cedula_maternidad');
    }

    public function validarCedulaReposoMaternidad(Request $request)
    {
        $cedula = $request->input('cedula');
        $nacionalidad = $request->input('nacionalidad');

        // Formatea el número de cédula según la nacionalidad y agrega ceros
        if ($nacionalidad == 1) {
            // Venezolano
            $formattedCedula = '1' . str_pad($cedula, 9, '0', STR_PAD_LEFT);
        } else {
            // Extranjero
            $formattedCedula = '2' . str_pad($cedula, 9, '0', STR_PAD_LEFT);
        }

        // Realiza la consulta a la base de datos
        $asegurado = AseguradoEmpresa::where('id_asegurado', $formattedCedula)->first();

        if ($asegurado) {
            // Almacenar la cédula en la sesión
            session(['cedula' => $formattedCedula]);
            return redirect()->route('nuevo.reposo.maternidad.view');
        } else {
            return redirect()->back()->withErrors(['cedula' => 'No se encontró ningún asegurado con esa cédula.']);
        }
    }

    public function nuevoReposoMaternidadView()
    {
        $servicios = Servicio::all();
        $capitulos = Capitulo::where('id', 16)->get();
        $patologiasGenerales = PatologiaGeneral::where('capitulo_id', 16)->get();
        $patologiasEspecificas = PatologiaEspecifica::where('capitulo_id', 16)->get();
        $lugares = Lugar::all();
        $motivos = Motivo::all();

        // Añade un registro de depuración
        Log::info('Patologías Generales:', ['patologiasGenerales' => $patologiasGenerales]);

        return view('reposos.nuevo_reposo_maternidad', compact('servicios', 'capitulos', 'patologiasGenerales', 'patologiasEspecificas', 'lugares', 'motivos'));
    }

    public function getPatologiasGenerales($id)
    {
        $patologiasGenerales = PatologiaGeneral::where('capitulo_id', $id)->get();
        
        // Asegúrate de devolver JSON
        return response()->json($patologiasGenerales);
    }

    public function createReposoMaternidad(Request $request)
    {
        // Validación de datos
        $validatedData = $request->validate([
            'id_pat_general' => 'required|numeric',
            'id_pat_especifica' => 'numeric',
            'id_lugar' => 'required|numeric',
            'cod_motivo' => 'required|numeric',
            'inicio_reposo' => 'required|date',
            'fin_reposo' => 'required|date',
            'reintegro' => 'required|date',
            'debe_volver' => 'required|boolean',
            'observaciones' => 'nullable|string',
            'email_trabajador' => 'required|email',
        ]);

        try {
            DB::transaction(function () use ($request, &$maxId, &$expediente, &$reposo, &$forma_14144) {
                $maxId = DB::table('reposos')->max('id');

                $cedula = session('cedula');
                $usuario = auth()->user();

                // Verificar y ajustar la cédula para buscar en la tabla Ciudadano
                $prefijo = substr($cedula, 0, 1) === '1' ? 'V' : (substr($cedula, 0, 1) === '2' ? 'E' : null);
                $cedulaAjustada = $prefijo ? $prefijo . substr($cedula, 1) : $cedula;

                // Buscar ciudadano en la tabla Ciudadano
                $ciudadano = Ciudadano::where('id_ciudadano', $cedulaAjustada)->first();

                // Buscar el id_asegurado y id_empresa en la tabla Asegurado_Empresa usando la cédula y con estatus Activo
                $aseguradoEmpresa = AseguradoEmpresa::where('id_asegurado', $cedula)
                                                    ->where('id_estatus_asegurado', 'A')
                                                    ->whereNotNull('id_empresa')
                                                    ->whereNotNull('id_asegurado')
                                                    ->first();

                $idAsegurado = $aseguradoEmpresa->id_asegurado;
                $idEmpresa = $aseguradoEmpresa->id_empresa;
                $salarioMensual = $aseguradoEmpresa->salario_mensual;

                if (!$idEmpresa) {
                    return redirect()->back()->with('error', 'No se encontró la empresa asociada al asegurado.');
                }

                // Buscar o crear el expediente asociado y actualizar cantidad_reposos si ya existe
                $expediente = Expediente::firstOrNew(['cedula' => $cedula]);

                if ($expediente->exists) {
                    $expediente->cantidad_reposos += 1;
                    $expediente->id_update = auth()->user()->id;
                    $expediente->fecha_update = now();

                    // Buscar todos los reposos de la persona y sumar los días indemnizables
                    $totalDiasIndemnizar = Reposo::where('cedula', $cedula)->sum('dias_indemnizar');
                    $expediente->dias_acumulados = $totalDiasIndemnizar;
                } else {
                    $expediente->cantidad_reposos = 1;
                    $expediente->cantidad_prorrogas = 0;
                    $expediente->dias_acumulados = 0;
                    $expediente->semanas_acumuladas = 0;
                    $expediente->dias_pendientes = 0;
                    $expediente->id_ultimo_cent_asist = auth()->user()->id_centro_asistencial;
                    $expediente->es_abierto = true;
                    $expediente->id_create = auth()->user()->id;
                    $expediente->fecha_create = now();
                }

                $expediente->save();

                // Establecer el cod_estatus según la cantidad de reposos
                $codEstatus = ($expediente->cantidad_reposos >= 4) ? 3 : 1;
                $inicioReposo = Carbon::parse($request->inicio_reposo);
                $finReposo = Carbon::parse($request->fin_reposo);
                $diasIndemnizar = $inicioReposo->diffInDays($finReposo) + 1; // +1 para incluir el día de inicio

                // Obtener los días de reposo de la patología general
                $patologiaGeneral = PatologiaGeneral::findOrFail($request->id_pat_general);
                $diasReposo = $patologiaGeneral->dias_reposo;

                // Validar que los días a indemnizar no sean mayores que los días de reposo
                if ($diasIndemnizar > $diasReposo) {
                    return redirect()->back()->with('error', 'Los días a indemnizar no pueden ser mayores que los días de reposo de la patología general seleccionada.');
                }

                // Crear el reposo
                $reposo = Reposo::create([
                    'id' => $maxId + 1,
                    // 'numero_ref_reposo' => $request->numero_ref_reposo,
                    'id_expediente' => $expediente->id,
                    'cedula' => $cedula,
                    'id_empresa' => $idEmpresa, // Agregar id_empresa obtenido
                    'id_servicio' => auth()->user()->id_servicio,
                    'id_capitulo' => 16,
                    'id_pat_general' => $request->id_pat_general,
                    'id_pat_especifica' => $request->id_pat_especifica,
                    'id_lugar' => $request->id_lugar,
                    'cod_motivo' => $request->cod_motivo,
                    'inicio_reposo' => $request->inicio_reposo,
                    'fin_reposo' => $request->fin_reposo,
                    'reintegro' => $request->reintegro,
                    'debe_volver' => $request->debe_volver,
                    'convalidado' => 1,
                    'es_enfermedad' => 0,
                    'es_prenatal' => $request->es_prenatal,
                    'es_postnatal' => $request->es_postnatal,
                    'cod_estatus' => $codEstatus, // Establecer cod_estatus
                    'dias_indemnizar' => $diasIndemnizar,
                    'id_create' => auth()->user()->id,
                    'fecha_create' => now(),
                    'id_cent_asist' => auth()->user()->id_centro_asistencial,
                    'observaciones' => strtoupper($request->observaciones),
                    'email_trabajador' => strtoupper($request->email_trabajador),
                ]);

                // Incrementar el campo nro_reposo_1473 en la tabla CentroAsistencial
                $centroAsistencial = CentroAsistencial::where('id', $usuario->id_centro_asistencial)->first();
                $centroAsistencial->nro_reposo_1473 += 1;
                $centroAsistencial->save();

                $totalDiasIndemnizar = Reposo::where('cedula', $cedula)->sum('dias_indemnizar');
                $expediente->dias_acumulados = $totalDiasIndemnizar;
                $expediente->id_ultimo_reposo = $reposo->id;
                $expediente->save();

                $indemnizacionesDiarias = $salarioMensual / $diasIndemnizar;

                $forma_14144 = Forma_14144::create([
                    'id_forma14144' => $maxId + 1,
                    'id_centro_asistencial' => auth()->user()->id_centro_asistencial,
                    'numero_relacion' => $maxId,
                    'fecha_elaboracion' => now(),
                    'numero_pagina' => 1,
                    'id_empresa' => $idEmpresa,
                    'id_asegurado' => $cedula,
                    'tipo_atencion' => 1,
                    'fecha_comienzo' => $request->inicio_reposo,
                    'tipo_concepto' => 1,
                    'fecha_desde' => $request->inicio_reposo,
                    'fecha_hasta' => $request->fin_reposo,
                    'dias_reposo' => $diasIndemnizar,
                    'dias_indemnizar' => $diasIndemnizar,
                    'monto_diario_indemnizar' => $indemnizacionesDiarias,
                    'certificado_incapacidad' => 'N',
                    'id_usuario' => auth()->user()->id,
                    'fecha_transcripcion' => now(),
                    'pago_factura' => 'N',
                ]);

                // Formatear la cédula para el PDF
                $cedula = $reposo->cedula;
                $formattedCedula = ltrim(substr($cedula, 1), '0'); // Eliminar ceros de relleno
                $prefix = substr($cedula, 0, 1);
                if ($prefix == '1') {
                    $prefix = 'V';
                } elseif ($prefix == '2') {
                    $prefix = 'E';
                }
                $cedulaFormateada = $prefix . '-' . $formattedCedula;

                // Generar PDF
                $data = [
                    'reposo' => $reposo,
                    'expediente' => $expediente,
                    'aseguradoEmpresa' => $aseguradoEmpresa,
                    'ciudadano' => $ciudadano, // Agregar los datos del ciudadano a la data
                    'usuario' => $usuario, // Pasar el usuario autenticado a la vista
                    'cedula_formateada' => $cedulaFormateada, // Pasar la cédula formateada a la vista
                    'fecha_elaboracion' => now()->format('d/m/Y'),
                ];

                $pdf = PDF::loadView('reposos.certificado_pdf', $data);
                $pdf->save(storage_path('app/public/app/assets/certificados/F-14-73_ENFERMEDAD_'.$reposo->id.'.pdf'));
            });

            return redirect('/inicio')->with('success', 'Reposo registrado exitosamente!');
            
        } catch (\Exception $e) {
            Log::error('Error al registrar el Reposo: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Error al registrar el Reposo. Inténtalo nuevamente.');
        }
    }
}
