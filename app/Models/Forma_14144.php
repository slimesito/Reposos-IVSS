<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forma_14144 extends Model
{
    use HasFactory;

    protected $connection = 'oracle2';
    protected $table = 'PRESTACIONES.FORMA_14144';
    public $timestamps = false;

    protected $fillable = [
        'id_forma14144',
        'id_centro_asistencial',
        'numero_relacion',
        'fecha_elaboracion',
        'numero_pagina',
        'id_empresa',
        'id_asegurado',
        'tipo_atencion',
        'fecha_comienzo',
        'tipo_concepto',
        'fecha_desde',
        'fecha_hasta',
        'dias_reposo',
        'fecha_prenatal',
        'fecha_postnatal',
        'dias_indemnizar',
        'monto_diario_indemnizar',
        'certificado_incapacidad',
        'estatus_registro',
        'id_oficina_ivss',
        'id_usuario',
        'fecha_transcripcion',
        'pago_factura',
        'id_banco',
        'nro_cuenta',
        'fecha_pago',
        'tipo_mat'
    ];

    // Indicar que no hay clave primaria
    protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'string';
}
