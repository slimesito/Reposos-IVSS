<?php

namespace App\Http\Controllers\Expediente;

use App\Http\Controllers\Controller;
use App\Models\Expediente;
use App\Models\Prorroga;
use App\Models\Reposo;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    public function showPacientes()
    {
        $expedientes = Expediente::paginate(10);

        return view('expediente.pacientes', compact('expedientes'));
    }

    public function buscadorPacientes(Request $request)
    {
        $query = $request->input('pacientesQuery');

        $expedientes = Expediente::where('cedula', 'LIKE', "%{$query}%")
            ->paginate(10)
            ->appends(['pacientesQuery' => $request->input('pacientesQuery')]);

        return view('expediente.resultados_busqueda_pacientes', compact('expedientes'));
    }

    public function showReposos()
    {
        $user = auth()->user();
        
        if ($user->cod_cargo == 4) {
            $reposos = Reposo::paginate(10);
        } else {
            $reposos = Reposo::where('id_cent_asist', $user->id_centro_asistencial)->paginate(10);
        }

        return view('expediente.reposos', compact('reposos'));
    }

    public function buscadorReposos(Request $request)
    {
        $user = auth()->user();
        $query = $request->input('repososQuery');

        $reposos = Reposo::query();

        if ($user->cod_cargo != 4) {
            $reposos->where('id_cent_asist', $user->id_centro_asistencial);
        }

        $reposos = $reposos->where('cedula', 'LIKE', "%{$query}%")->paginate(10)->appends(['repososQuery' => $query]);

        return view('expediente.resultados_busqueda_reposos', compact('reposos'));
    }

    public function showProrrogas()
    {
        $user = auth()->user();
        
        if ($user->cod_cargo == 4) {
            // Si el usuario es Master, se muestran todas las prorrogas
            $prorrogas = Prorroga::paginate(10);
        } else {
            // Sino, filtrar por id_centro_asistencial
            $prorrogas = Prorroga::where('id_cent_asist', $user->id_centro_asistencial)->paginate(10);
        }

        return view('expediente.prorrogas', compact('prorrogas'));
    }

    public function buscadorProrrogas(Request $request)
    {
        $user = auth()->user();
        $query = $request->input('prorrogasQuery');

        $prorrogas = Prorroga::query();

        if ($user->cod_cargo != 4) {
            // Si el usuario no tiene cod_cargo 4, filtrar por id_cent_asist
            $prorrogas->where('id_cent_asist', $user->id_centro_asistencial);
        }

        // Filtrar por cédula y paginar el resultado
        $prorrogas = $prorrogas->where('cedula', 'LIKE', "%{$query}%")->paginate(10)->appends(['prorrogasQuery' => $query]);

        return view('expediente.resultados_busqueda_prorrogas', compact('prorrogas'));
    }
}
