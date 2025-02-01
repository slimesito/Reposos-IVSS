<?php

namespace App\Http\Controllers\Reposos;

use App\Helpers\StringHelpers;
use App\Http\Controllers\Controller;
use App\Models\Reposo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    public function gestionRepososView()
    {
        $reposos = Reposo::with('servicio', 'capitulo')->where('cod_estatus', 3)->paginate(10);

        // Formatear la cédula en el controlador
        foreach ($reposos as $reposo) {
            $cedula = ltrim(substr($reposo->cedula, 1), '0');
            $prefix = substr($reposo->cedula, 0, 1);
            if ($prefix == '1') {
                $prefix = 'V';
            } elseif ($prefix == '2') {
                $prefix = 'E';
            }
            $reposo->cedula_formateada = $prefix . '-' . $cedula;
        }

        return view('gestion.reposos', compact('reposos'));
    }

    public function buscadorRepososPendientes(Request $request)
    {
        $query = StringHelpers::strtoupper_searchRepososPendientes($request->input('repososPendientesQuery'));

        $reposos = Reposo::where('cedula', 'LIKE', '%' . $query . '%')
            ->paginate(20)
            ->appends(['repososPendientesQuery' => $request->input('repososPendientesQuery')]);

        // Formatear la cédula en el controlador
        foreach ($reposos as $reposo) {
            $cedula = ltrim(substr($reposo->cedula, 1), '0');
            $prefix = substr($reposo->cedula, 0, 1);
            if ($prefix == '1') {
                $prefix = 'V';
            } elseif ($prefix == '2') {
                $prefix = 'E';
            }
            $reposo->cedula_formateada = $prefix . '-' . $cedula;
        }

        return view('gestion.resultados_busqueda', compact('reposos'));
    }

    public function aprobarReposo($id)
    {
        $reposo = Reposo::findOrFail($id);
        $reposo->cod_estatus = 1;
        $reposo->id_validacion = auth()->user()->id;
        $reposo->fecha_validacion = now();
        $reposo->save();

        return redirect()->back()->with('success', 'Reposo aprobado correctamente.');
    }

    public function rechazarReposo($id)
    {
        $reposo = Reposo::findOrFail($id);
        $reposo->cod_estatus = 5;
        $reposo->id_anulacion = auth()->user()->id;
        $reposo->fecha_anulacion = now();
        $reposo->save();

        return redirect()->back()->with('success', 'Reposo rechazado correctamente.');
    }
}
