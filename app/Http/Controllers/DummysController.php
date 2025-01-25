<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DummysController extends Controller
{
    public function index()
    {
        try {
            if (DB::connection()->getDatabaseName()) {
                echo "Si! Conectado con exito a la base de datos: " .
                DB::connection()->getDatabaseName();
            }else {
                die("No se pudo encontrar la base de datos.
                Comprueba tu configuracion");
            }
        } catch (\Exception $e) {
            die("No se pudo conectar a la base de datos. Error: " . $e );
        }
    }
}
