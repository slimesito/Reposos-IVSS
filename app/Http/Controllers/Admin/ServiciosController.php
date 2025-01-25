<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StringHelpers;
use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiciosController extends Controller
{
    public function gestionServiciosView()
    {
        $servicios = Servicio::orderBy('cod_servicio')->paginate(20);

        return view('admin.servicios.gestion_servicios', ['servicios' => $servicios]);
    }

    public function buscadorServicios(Request $request)
    {
        $query = StringHelpers::strtoupper_searchServicio($request->input('serviciosQuery'));

        $servicios = Servicio::where('nombre', 'LIKE', '%' . $query . '%')
            ->paginate(10)
            ->appends(['serviciosQuery' => $request->input('serviciosQuery')]);

        return view('admin.servicios.resultados_busqueda', compact('servicios'));
    }

    public function createServicioView()
    {
        return view('admin.servicios.nuevo_servicio');
    }

    public function createServicio(Request $request)
    {
        $request->validate([
            'cod_servicio' => 'required|numeric|unique:servicios,cod_servicio',
            'nombre' => 'required|max:250|unique:servicios,nombre',
            'tiempo_cita' => 'required|numeric',
            'autoriza_maternidad' => 'required|boolean',
        ]);

        try {
            // Obtener el siguiente valor de la secuencia para el campo id
            $nextId = DB::selectOne("SELECT BDSAIVSSID.SERVICIOS_ID_SEQ.NEXTVAL as id FROM dual")->id;

            // Crear el nuevo registro
            Servicio::create([
                'id' => $nextId,
                'cod_servicio' => $request->cod_servicio,
                'nombre' => StringHelpers::strtoupper_createServicio($request->nombre),
                'tiempo_cita' => $request->tiempo_cita,
                'autoriza_maternidad' => $request->autoriza_maternidad,
                'activo' => true,
                'id_create' => auth()->user()->id,
                'fecha_create' => now(),
            ]);

            return redirect('/gestion_servicios')->with('success', 'Servicio registrado correctamente!');
        
        } catch (\Exception $e) {
            Log::error('Error al registrar el Servicio: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al registrar el Servicio. Inténtalo nuevamente.');
        }
    }

    public function editarServicioView($id)
    {
        $servicio = Servicio::findOrFail($id);
        return view('admin.servicios.editar_servicios', compact('servicio'));
    }

    public function updateServicio(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        $rules = [
            'tiempo_cita' => 'required|numeric',
            'autoriza_maternidad' => 'required|boolean',
            'activo' => 'required|boolean',
        ];

        // Validación condicional para cod_servicio
        if ($request->input('cod_servicio') !== $servicio->cod_servicio) {
            $rules['cod_servicio'] = 'required|numeric|unique:servicios';
        }

        // Validación condicional para nombre
        if (StringHelpers::strtoupper_updateServicio($request->input('nombre')) !== $servicio->nombre) {
            $rules['nombre'] = 'required|max:250|unique:servicios';
        }

        // Validar la solicitud
        $request->validate($rules);

        // Actualizar los campos
        if ($request->has('cod_servicio')) {
            $servicio->cod_servicio = $request->input('cod_servicio');
        }
        if ($request->has('nombre')) {
            $servicio->nombre = StringHelpers::strtoupper_updateServicio($request->input('nombre'));
        }
        $servicio->tiempo_cita = $request->input('tiempo_cita');
        $servicio->autoriza_maternidad = $request->input('autoriza_maternidad');
        $servicio->activo = $request->input('activo');
        $servicio->id_update = auth()->user()->id;
        $servicio->fecha_update = now();

        // Guardar los cambios
        $servicio->save();

        return redirect('/gestion_servicios')->with('success', 'Servicio actualizado correctamente.');
    }

    public function destroyServicio($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();

        return redirect()->back()->with('success', 'Servicio eliminado correctamente');
    }
}
