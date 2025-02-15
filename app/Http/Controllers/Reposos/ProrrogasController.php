<?php

namespace App\Http\Controllers\Reposos;

use App\Helpers\StringHelpers;
use App\Http\Controllers\Controller;
use App\Models\AseguradoEmpresa;
use App\Models\Capitulo;
use App\Models\Ciudadano;
use App\Models\Expediente;
use App\Models\Lugar;
use App\Models\Motivo;
use App\Models\PatologiaEspecifica;
use App\Models\PatologiaGeneral;
use App\Models\Prorroga;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProrrogasController extends Controller
{
    public function validarCedulaProrrogaView()
    {
        return view('reposos.validar_cedula_prorroga');
    }

    public function validarCedulaProrroga(Request $request)
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
            return redirect()->route('nueva.prorroga.view');
        } else {
            return redirect()->back()->withErrors(['cedula' => 'No se encontró ningún asegurado con esa cédula.']);
        }
    }

    public function nuevaProrrogaView()
    {
        $capitulos = Capitulo::all();
        return view('reposos.nueva_prorroga', compact('capitulos'));
    }

    public function getPatologiasGenerales($capituloId)
    {
        $patologiasGenerales = PatologiaGeneral::where('capitulo_id', $capituloId)->get();
        return response()->json($patologiasGenerales);
    }

    public function getPatologiasEspecificasPorCapitulo($capituloId)
    {
        $patologiasEspecificas = PatologiaEspecifica::where('capitulo_id', $capituloId)->get();
        return response()->json($patologiasEspecificas);
    }

    public function createProrroga(Request $request)
    {
        $request->validate([
            'id_capitulo' => 'required|numeric',
            'id_pat_general' => 'required|numeric',
            'id_pat_especifica' => 'numeric',
            'evolucion' => 'required|string',
            'observaciones' => 'nullable|string',
            'inicio_prorroga' => 'required|date',
            'fin_prorroga' => 'required|date',
            'telefono' => 'nullable|numeric',
        ]);

        try {
            DB::transaction(function () use ($request, &$maxId, &$expediente, &$prorroga) {
                // Obtener el siguiente valor de la secuencia y asignarlo a maxId
                $maxId = DB::table('prorrogas')->max('id');

                // Obtener la cédula desde la sesión
                $cedula = session('cedula');
                $usuario = auth()->user(); // Obtener el usuario autenticado

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

                // Buscar o crear el expediente asociado y actualizar cantidad_prorrogas si ya existe
                $expediente = Expediente::firstOrNew(['cedula' => $cedula]);

                if ($expediente->exists) {
                    $expediente->cantidad_prorrogas += 1;
                    $expediente->id_update = auth()->user()->id;
                    $expediente->fecha_update = now();
                }

                $expediente->save();

                $inicioProrroga = Carbon::parse($request->inicio_prorroga);
                $finProrroga = Carbon::parse($request->fin_prorroga);
                $diasIndemnizar = $inicioProrroga->diffInDays($finProrroga) + 1; // +1 para incluir el día de inicio

                // Crear la prórroga
                $prorroga = Prorroga::create([
                    'id' => $maxId + 1,
                    // 'numero_ref_prorroga' => $request->numero_ref_prorroga,
                    'id_expediente' => $expediente->id,
                    'cedula' => $cedula,
                    'id_cent_asist' => auth()->user()->id_centro_asistencial,
                    'id_servicio' => auth()->user()->id_servicio,
                    'id_capitulo' => $request->id_capitulo,
                    'id_pat_general' => $request->id_pat_general,
                    'id_pat_especifica' => $request->id_pat_especifica,
                    'evolucion' => StringHelpers::strtoupper_createProrrogas($request->evolucion),
                    'estatus' => 'Pendiente',
                    'observaciones' => StringHelpers::strtoupper_createProrrogas($request->observaciones),
                    'id_create' => auth()->user()->id,
                    'fecha_create' => now(),
                    'inicio_prorroga' => $request->inicio_prorroga,
                    'fin_prorroga' => $request->fin_prorroga,
                    'telefono' => $request->telefono,
                ]);

                // Actualizar el expediente con el ID del último reposo
                $expediente->id_ultima_prorroga = $prorroga->id;
                $expediente->save();

                // Formatear la cédula para el PDF
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
                    'prorroga' => $prorroga,
                    'expediente' => $expediente,
                    'aseguradoEmpresa' => $aseguradoEmpresa,
                    'ciudadano' => $ciudadano, // Agregar el ciudadano a la data
                    'usuario' => auth()->user(), // Pasar el usuario autenticado a la vista
                    'cedula_formateada' => $cedulaFormateada, // Pasar la cédula formateada a la vista
                    'fecha_elaboracion' => now()->format('d/m/Y'),
                ];

                $pdf = Pdf::loadView('reposos.certificado_prorroga_pdf', $data);
                $pdf->save(storage_path('app/public/app/assets/certificados/prorrogas/F-14-73_PRORROGA_'.$prorroga->id.'.pdf'));
            });

            return redirect('/inicio')->with('success', 'Prórroga creada exitosamente!');
        } catch (\Exception $e) {
            // Registrar el error en el log de Laravel
            Log::error('Error al registrar la Prórroga: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Error al registrar la Prórroga. Inténtalo nuevamente.');
        }
    }
}
