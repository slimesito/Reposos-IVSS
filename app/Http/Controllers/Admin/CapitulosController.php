<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StringHelpers;
use App\Http\Controllers\Controller;
use App\Models\Capitulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CapitulosController extends Controller
{
    public function gestionCapitulosView()
    {
        $capitulos = Capitulo::orderBy('id')->paginate(10);

        return view('admin.capitulos.gestion_capitulos', ['capitulos' => $capitulos]);
    }

    public function buscadorCapitulos(Request $request)
    {
        $query = StringHelpers::strtoupper_searchCapitulos($request->input('capitulosQuery'));

        $capitulos = Capitulo::where('descripcion', 'LIKE', '%' . $query . '%')
            ->paginate(10)
            ->appends(['capitulosQuery' => $request->input('capitulosQuery')]);

        return view('admin.capitulos.resultados_busqueda', compact('capitulos'));
    }

    public function createCapitulosView()
    {
        return view('admin.capitulos.nuevo_capitulo');
    }

    public function createCapitulos(Request $request)
    {
        $request->validate([
            'capitulo_id' => 'required|max:150|unique:capitulos,capitulo_id',
            'descripcion' => 'required|max:150|unique:capitulos,descripcion',
        ]);

        try {

            $maxId = DB::table('capitulos')->max('id');

            Capitulo::create([
                'id' => $maxId + 1,
                'capitulo_id' => StringHelpers::strtoupper_createCapitulos($request->capitulo_id),
                'descripcion' => StringHelpers::strtoupper_createCapitulos($request->descripcion),
                'activo' => true,
                'id_create' => auth()->user()->id,
                'fecha_create' => now(),
            ]);

            return redirect('/gestion_capitulos')->with('success', 'Capítulo registrado correctamente!');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al registrar el Capítulo. Inténtalo nuevamente.');
        }
    }

    public function editarCapitulosView($id)
    {
        $capitulo = Capitulo::findOrFail($id);
        return view('admin.capitulos.editar_capitulos', compact('capitulo'));
    }

    public function updateCapitulos(Request $request, $id)
    {
        $capitulo = Capitulo::findOrFail($id);

        $request->validate([
            'capitulo_id' => 'required|max:150|unique:capitulos,capitulo_id,' . $id,
            // 'descripcion' => 'required|max:150|unique:capitulos,descripcion,' . $id,
            'activo' => 'required|boolean',
        ]);

        $capitulo->capitulo_id = StringHelpers::strtoupper_createCapitulos($request->input('capitulo_id'));
        $capitulo->descripcion = StringHelpers::strtoupper_updateCapitulos($request->input('descripcion'));
        $capitulo->activo = $request->input('activo');
        $capitulo->id_update = auth()->user()->id;
        $capitulo->fecha_update = now();

        $capitulo->save();

        return redirect('/gestion_capitulos')->with('success', 'Capítulo actualizado correctamente.');
    }

    public function destroyCapitulos($id)
    {
        $capitulo = Capitulo::findOrFail($id);
        $capitulo->delete();

        return redirect()->back()->with('success', 'Capítulo eliminado correctamente');
    }
}
