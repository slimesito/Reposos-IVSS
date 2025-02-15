<?php

namespace App\Http\Controllers;

use App\Models\CentroAsistencial;
use App\Models\Estado;
use App\Models\Expediente;
use App\Models\Prorroga;
use App\Models\Reposo;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Datos para el gráfico de pie (reposos por tipo y prórrogas)
        $enfermedadCount = Reposo::where('es_enfermedad', true)->count();
        $prenatalCount = Reposo::where('es_prenatal', true)->count();
        $postnatalCount = Reposo::where('es_postnatal', true)->count();
        $prorrogasCount = Prorroga::count(); // Contar la cantidad de prórrogas

        // Datos para el gráfico de barras (reposos por estado)
        $estados = Estado::with(['centrosAsistenciales.reposos'])->get();

        $labels = [];
        $data = [];

        foreach ($estados as $estado) {
            $labels[] = $estado->nombre; // Nombre del estado

            // Contar los reposos para este estado
            $repososCount = 0;
            foreach ($estado->centrosAsistenciales as $centro) {
                $repososCount += $centro->reposos->count();
            }

            $data[] = $repososCount; // Cantidad de reposos para este estado
        }

        // Datos para el gráfico de barras (expedientes por mes)
        $expedientesPorMes = Expediente::selectRaw('TO_CHAR(fecha_create, \'YYYY-MM\') as mes, COUNT(*) as cantidad')
            ->groupBy(DB::raw('TO_CHAR(fecha_create, \'YYYY-MM\')')) // Repetir la expresión aquí
            ->orderBy(DB::raw('TO_CHAR(fecha_create, \'YYYY-MM\')')) // Repetir la expresión aquí
            ->get();

        $expedientesLabels = [];
        $expedientesData = [];

        foreach ($expedientesPorMes as $expediente) {
            $expedientesLabels[] = $expediente->mes; // Mes (en formato YYYY-MM)
            $expedientesData[] = $expediente->cantidad; // Cantidad de expedientes
        }

        // Pasar todos los datos a la vista
        return view('dashboard', compact(
            'enfermedadCount',
            'prenatalCount',
            'postnatalCount',
            'prorrogasCount', // Pasar la cantidad de prórrogas
            'labels',
            'data',
            'expedientesLabels',
            'expedientesData'
        ));
    }
}
