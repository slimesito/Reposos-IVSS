<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StringHelpers;
use App\Http\Controllers\Controller;
use App\Models\Capitulo;
use App\Models\PatologiaEspecifica;
use App\Models\PatologiaGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatologiasEspecificasController extends Controller
{
    public function gestionPatologiasEspecificasView()
    {
        $patologiasEspecificas = PatologiaEspecifica::orderBy('id')->paginate(30);

        return view('admin.patologias_especificas.gestion_patologias_especificas', ['patologiasEspecificas' => $patologiasEspecificas]);
    }

    public function buscadorPatologiasEspecificas(Request $request)
    {
        $query = StringHelpers::strtoupper_searchPatologiaEspecifica($request->input('patologiaEspecificaQuery'));

        $patologiasEspecificas = PatologiaEspecifica::where('descripcion', 'LIKE', '%' . $query . '%')
            ->paginate(10)
            ->appends(['patologiaEspecificaQuery' => $request->input('patologiaEspecificaQuery')]);

        return view('admin.patologias_especificas.resultados_busqueda', compact('patologiasEspecificas'));
    }

    public function createPatologiasEspecificasView()
    {
        $capitulos = Capitulo::all();
        return view('admin.patologias_especificas.nueva_patologia_especifica', compact('capitulos'));
    }

    public function getPatologiasGenerales($capituloId)
    {
        $patologiasGenerales = PatologiaGeneral::where('capitulo_id', $capituloId)->get();
        return response()->json($patologiasGenerales);
    }

    public function createPatologiasEspecificas(Request $request)
    {
        $request->validate([
            'capitulo_id' => 'required|numeric|max:19',
            'id_pat_general' => 'required|max:19|',
            'cod_pat_especifica' => 'required|max:19|',
            'id_pat_especifica' => 'required|max:19|',
            'descripcion' => 'required|max:250|unique:patologias_especificas,descripcion',
            'dias_reposo' => 'required|numeric',
        ]);

        try {
            // Obtener el siguiente valor de la secuencia para el campo id
            $nextId = DB::selectOne("SELECT BDSAIVSSID.PATOLOGIAS_ESPECIFICAS_ID_SEQ.NEXTVAL as id FROM dual")->id;

            // Crear el nuevo registro
            PatologiaEspecifica::create([
                'id' => $nextId,
                'capitulo_id' => $request->capitulo_id,
                'id_pat_general' => $request->id_pat_general,
                'cod_pat_especifica' => $request->id_pat_general,
                'id_pat_especifica' => $request->id_pat_general,
                'descripcion' => StringHelpers::strtoupper_createPatologiaEspecifica($request->descripcion),
                'dias_reposo' => $request->dias_reposo,
                'activo' => true,
                'id_create' => auth()->user()->id,
                'fecha_create' => now(),
            ]);

            return redirect('/gestion_patologias_especificas')->with('success', 'Patología Específica registrada correctamente!');
        
        } catch (\Exception $e) {
            Log::error('Error al registrar la Patología Específica: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al registrar la Patología Específica. Inténtalo nuevamente.');
        }
    }

    public function editarPatologiasEspecificasView($id)
    {
        $patologiaEspecifica = PatologiaEspecifica::findOrFail($id);
        return view('admin.patologias_especificas.editar_patologias_especificas', compact('patologiaEspecifica'));
    }

    public function updatePatologiasEspecificas(Request $request, $id)
    {
        $patologiaEspecifica = PatologiaEspecifica::findOrFail($id);

        $request->validate([
            'capitulo_id' => 'required|numeric|max:19',
            'id_pat_general' => 'required|max:19|',
            'cod_pat_especifica' => 'required|max:19|',
            'id_pat_especifica' => 'required|max:19|',
            'descripcion' => 'required|max:250|unique:patologias_especificas,descripcion',
            'dias_reposo' => 'required|numeric',
            'activo' => 'required|boolean',
        ]);

        $patologiaEspecifica->capitulo_id = $request->input('capitulo_id');
        $patologiaEspecifica->id_pat_general = $request->input('id_pat_general');
        $patologiaEspecifica->cod_pat_especifica = $request->input('cod_pat_especifica');
        $patologiaEspecifica->id_pat_especifica = $request->input('id_pat_especifica');
        $patologiaEspecifica->descripcion = StringHelpers::strtoupper_updatePatologiaGeneral($request->input('descripcion'));
        $patologiaEspecifica->dias_reposo = $request->input('dias_reposo');
        $patologiaEspecifica->activo = $request->input('activo');
        $patologiaEspecifica->id_update = auth()->user()->id;
        $patologiaEspecifica->fecha_update = now();

        $patologiaEspecifica->save();

        return redirect('/gestion_patologias_especificas')->with('success', 'Patología Específica actualizada correctamente.');
    }

    public function destroyPatologiasEspecificas($id)
    {
        $patologiaEspecifica = PatologiaEspecifica::findOrFail($id);
        $patologiaEspecifica->delete();

        return redirect()->back()->with('success', 'Patología Específica eliminada correctamente');
    }
}
