<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StringHelpers;
use App\Http\Controllers\Controller;
use App\Models\PatologiaGeneral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatologiasGeneralesController extends Controller
{
    public function gestionPatologiasGeneralesView()
    {
        $patologiasGenerales = PatologiaGeneral::orderBy('pat_general_id')->paginate(30);

        return view('admin.patologias_generales.gestion_patologias_generales', ['patologiasGenerales' => $patologiasGenerales]);
    }

    public function buscadorPatologiasGenerales(Request $request)
    {
        $query = StringHelpers::strtoupper_searchPatologiaGeneral($request->input('patologiaGeneralQuery'));

        $patologiasGenerales = PatologiaGeneral::where('descripcion', 'LIKE', '%' . $query . '%')
            ->paginate(10)
            ->appends(['patologiaGeneralQuery' => $request->input('patologiaGeneralQuery')]);

        return view('admin.patologias_generales.resultados_busqueda', compact('patologiasGenerales'));
    }

    public function createPatologiasGeneralesView()
    {
        return view('admin.patologias_generales.nueva_patologia_general');
    }

    public function createPatologiasGenerales(Request $request)
    {
        $request->validate([
            'pat_general_id' => 'required|max:10|unique:patologias_generales,pat_general_id',
            'capitulo_id' => 'required|numeric|max:19',
            'descripcion' => 'required|max:250|unique:patologias_generales,descripcion',
            'dias_reposo' => 'required|numeric',
        ]);

        try {
            // Obtener el siguiente valor de la secuencia para el campo id
            $nextId = DB::selectOne("SELECT BDSAIVSSID.PATOLOGIAS_GENERALES_ID_SEQ.NEXTVAL as id FROM dual")->id;

            // Luego realiza la inserción
            PatologiaGeneral::create([
                'id' => $nextId,
                'pat_general_id' => StringHelpers::strtoupper_createPatologiaGeneral($request->pat_general_id),
                'capitulo_id' => $request->capitulo_id,
                'descripcion' => StringHelpers::strtoupper_createPatologiaGeneral($request->descripcion),
                'dias_reposo' => $request->dias_reposo,
                'activo' => true,
                'id_create' => auth()->user()->id,
                'fecha_create' => now(),
            ]);

            return redirect('/gestion_patologias_generales')->with('success', 'Patología General registrada correctamente!');
        
        } catch (\Exception $e) {
            Log::error('Error al registrar la Patología General: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al registrar la Patología General. Inténtalo nuevamente.');
        }
    }

    public function editarPatologiasGeneralesView($id)
    {
        $patologiaGeneral = PatologiaGeneral::findOrFail($id);
        return view('admin.patologias_generales.editar_patologias_generales', compact('patologiaGeneral'));
    }

    public function updatePatologiasGenerales(Request $request, $id)
    {
        $patologiaGeneral = PatologiaGeneral::findOrFail($id);

        $request->validate([
            'pat_general_id' => 'required|max:10|unique:patologias_generales,pat_general_id,' . $patologiaGeneral->id,
            'capitulo_id' => 'required|numeric|max:10',
            'descripcion' => 'required|max:250|unique:patologias_generales,descripcion,' . $patologiaGeneral->id, // Aquí incluimos el ID
            'dias_reposo' => 'required|numeric',
            'activo' => 'required|boolean',
        ]);

        $patologiaGeneral->pat_general_id = StringHelpers::strtoupper_updatePatologiaGeneral($request->input('pat_general_id'));
        $patologiaGeneral->capitulo_id = $request->input('capitulo_id');
        $patologiaGeneral->descripcion = StringHelpers::strtoupper_updatePatologiaGeneral($request->input('descripcion'));
        $patologiaGeneral->dias_reposo = $request->input('dias_reposo');
        $patologiaGeneral->activo = $request->input('activo');
        $patologiaGeneral->id_update = auth()->user()->id;
        $patologiaGeneral->fecha_update = now();

        $patologiaGeneral->save();

        return redirect('/gestion_patologias_generales')->with('success', 'Patología General actualizada correctamente.');
    }

    public function destroyPatologiasGenerales($id)
    {
        $patologiaGeneral = PatologiaGeneral::findOrFail($id);
        $patologiaGeneral->delete();

        return redirect()->back()->with('success', 'Patología General eliminada correctamente');
    }
}
