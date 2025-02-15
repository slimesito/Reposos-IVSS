<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StringHelpers;
use App\Http\Controllers\Controller;
use App\Models\CentroAsistencial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CentrosAsistencialesController extends Controller
{
    public function gestionCentroAsistencialView()
    {
        $centrosAsistenciales = CentroAsistencial::orderBy('cod_centro')->paginate(30);

        return view('admin.centros_asistenciales.gestion_centros_asistenciales', ['centrosAsistenciales' => $centrosAsistenciales]);
    }

    public function buscadorCentroAsistencial(Request $request)
    {
        $query = StringHelpers::strtoupper_searchCentrosAsistenciales($request->input('centroAsistencialQuery'));

        $centrosAsistenciales = CentroAsistencial::where('nombre', 'LIKE', '%' . $query . '%')
            ->paginate(10)
            ->appends(['centroAsistencialQuery' => $request->input('centroAsistencialQuery')]);

        return view('admin.centros_asistenciales.resultados_busqueda', compact('centrosAsistenciales'));
    }

    public function createCentroAsistencialView()
    {
        return view('admin.centros_asistenciales.nuevo_centro_asistencial');
    }

    public function createCentroAsistencial(Request $request)
    {
        $request->validate([
            'cod_centro' => 'required|numeric|unique:centros_asistenciales,cod_centro',
            'nombre' => 'required|max:250|unique:centros_asistenciales,nombre',
            'cod_estado' => 'required|numeric|max:19',
            'es_hospital' => 'required|boolean',
            'cod_tipo' => 'required|numeric|max:19',
            'rango_ip' => 'required|max:11',
        ]);

        try {
            $maxId = DB::table('centros_asistenciales')->max('id');

            CentroAsistencial::create([
                'id' => $maxId + 1,
                'cod_centro' => $request->cod_centro,
                'nombre' => StringHelpers::strtoupper_createCentroAsistencial($request->nombre),
                'cod_estado' => $request->cod_estado,
                'es_hospital' => $request->es_hospital,
                'cod_tipo' => $request->cod_tipo,
                'rango_ip' => $request->rango_ip,
                'activo' => true,
                'id_create' => auth()->user()->id,
                'fecha_create' => now(),
            ]);

            return redirect('/gestion_centros_asistenciales')->with('success', 'Centro Asistencial registrado correctamente!');
        
        } catch (\Exception $e) {
            Log::error('Error al registrar el Centro Asistencial: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al registrar el Centro Asistencial. Inténtalo nuevamente.');
        }
    }

    public function editarCentroAsistencialView($id)
    {
        $centroAsistencial = CentroAsistencial::findOrFail($id);
        return view('admin.centros_asistenciales.editar_centros_asistenciales', compact('centroAsistencial'));
    }

    public function updateCentroAsistencial(Request $request, $id)
    {
        $centroAsistencial = CentroAsistencial::findOrFail($id);

        // Regla de validación base
        $rules = [
            'cod_estado' => 'required|numeric|max:19',
            'es_hospital' => 'required|boolean',
            'cod_tipo' => 'required|numeric|max:19',
            'rango_ip' => 'required|max:11',
            'activo' => 'required|boolean',
        ];

        // Validación condicional para cod_centro
        if ($request->input('cod_centro') !== $centroAsistencial->cod_centro) {
            $rules['cod_centro'] = 'required|numeric|unique:centros_asistenciales,cod_centro';
        }

        // Validación condicional para nombre
        if (StringHelpers::strtoupper_updateCentroAsistencial($request->input('nombre')) !== $centroAsistencial->nombre) {
            $rules['nombre'] = 'required|max:250|unique:centros_asistenciales,nombre';
        }

        // Validar la solicitud
        $request->validate($rules);

        // Actualizar los campos
        if ($request->has('cod_centro')) {
            $centroAsistencial->cod_centro = $request->input('cod_centro');
        }
        if ($request->has('nombre')) {
            $centroAsistencial->nombre = StringHelpers::strtoupper_updateCentroAsistencial($request->input('nombre'));
        }
        $centroAsistencial->cod_estado = $request->input('cod_estado');
        $centroAsistencial->es_hospital = $request->input('es_hospital');
        $centroAsistencial->cod_tipo = $request->input('cod_tipo');
        $centroAsistencial->rango_ip = $request->input('rango_ip');
        $centroAsistencial->activo = $request->input('activo');
        $centroAsistencial->id_update = auth()->user()->id;
        $centroAsistencial->fecha_update = now();

        // Guardar los cambios
        $centroAsistencial->save();

        return redirect('/gestion_centros_asistenciales')->with('success', 'Centro Asistencial actualizado correctamente.');
    }

    public function destroyCentroAsistencial($id)
    {
        $patologiaEspecifica = CentroAsistencial::findOrFail($id);
        $patologiaEspecifica->delete();

        return redirect()->back()->with('success', 'Centro Asistencial eliminado correctamente');
    }
}
