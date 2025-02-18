<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AseguradoEmpresa extends Model
{
    protected $connection = 'oracle2';
    protected $table = 'SIRA.ASEGURADO_EMPRESA';
    public $timestamps = false;

    protected $fillable = [
        'id_asegurado',
        'id_empresa',
        'fecha_ingreso',
        'fecha_egreso',
        'salario_semanal',
        'salario_mensual',
        'id_estatus_asegurado',
        'id_tipo_trabajador',
        'id_condicion_trabajador',
        'id_ocupacion',
        'cotizaciones',
        'salario_acumulado',
    ];
}
