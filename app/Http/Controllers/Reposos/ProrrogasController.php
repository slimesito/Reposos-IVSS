<?php

namespace App\Http\Controllers\Reposos;

use App\Http\Controllers\Controller;
use App\Models\AseguradoEmpresa;
use App\Models\Capitulo;
use App\Models\Expediente;
use App\Models\Lugar;
use App\Models\Motivo;
use App\Models\PatologiaEspecifica;
use App\Models\PatologiaGeneral;
use App\Models\Prorroga;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        ]);

        try {
            // Obtener el siguiente valor de la secuencia para el campo id de REPOSOS
            $nextIdProrroga = DB::selectOne("SELECT BDSAIVSSID.PRORROGAS_ID_SEQ.NEXTVAL as id FROM dual")->id;

            // Obtener la cédula desde la sesión
            $cedula = session('cedula');

            // Buscar el id_asegurado y id_empresa en la tabla AseguradoEmpresa usando la cédula
            $aseguradoEmpresa = AseguradoEmpresa::where('id_asegurado', $cedula)->first();
            $idAsegurado = $aseguradoEmpresa->id_asegurado ?? null;

            // Buscar o crear el expediente asociado y actualizar cantidad_prorrogas si ya existe
            $expediente = Expediente::firstOrNew(['cedula' => $cedula]);

            if ($expediente->exists) {
                $expediente->cantidad_prorrogas += 1;
                $expediente->id_update = auth()->user()->id;
                $expediente->fecha_update = now();
            }

            $expediente->save();

            // Crear la prórroga
            $prorroga = Prorroga::create([
                'id' => $nextIdProrroga,
                // 'numero_ref_prorroga' => $request->numero_ref_prorroga,
                'id_expediente' => $expediente->id,
                'cedula' => $cedula,
                'id_cent_asist' => auth()->user()->id_centro_asistencial,
                'id_servicio' => auth()->user()->id_servicio,
                'id_capitulo' => $request->id_capitulo,
                'id_pat_general' => $request->id_pat_general,
                'id_pat_especifica' => $request->id_pat_especifica,
                // 'evolucion' => $request->evolucion,
                'estatus' => 'Pendiente',
                // 'observaciones' => $request->observaciones,
                'id_create' => auth()->user()->id,
                'fecha_create' => now(),
            ]);

            // Actualizar el expediente con el ID del último reposo
            $expediente->id_ultima_prorroga = $prorroga->id;
            $expediente->save();

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
