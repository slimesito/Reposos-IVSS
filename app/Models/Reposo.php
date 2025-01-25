<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reposo extends Model
{
    use HasFactory;

    protected $connection = 'oracle';
    protected $table = 'reposos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'numero_ref_reposo',
        'id_expediente',
        'cedula',
        'indice',
        'id_empresa',
        'id_servicio',
        'id_capitulo',
        'id_pat_general',
        'id_pat_especifica',
        'id_lugar',
        'id_cent_asist',
        'cod_motivo',
        'inicio_reposo',
        'fin_reposo',
        'reintegro',
        'debe_volver',
        'convalidado',
        'es_enfermedad',
        'es_prenatal',
        'es_postnatal',
        'cod_estatus',
        'id_validacion',
        'fecha_validacion',
        'cod_tipo_anulacion',
        'observacion_anulacion',
        'id_anulacion',
        'fecha_anulacion',
        'observaciones',
        'tipo_pago',
        'total_reposo',
        'atencion',
        'dias_indemnizar',
        'id_create',
        'fecha_create',
        'id_cent_asist',
        'email_trabajador'
    ];

    // Relaciones

    public function expediente()
    {
        return $this->belongsTo(Expediente::class, 'id_expediente', 'id');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio', 'id');
    }

    public function capitulo()
    {
        return $this->belongsTo(Capitulo::class, 'id_capitulo', 'id');
    }

    public function patologiaGeneral()
    {
        return $this->belongsTo(PatologiaGeneral::class, 'id_pat_general', 'id');
    }

    public function patologiaEspecifica()
    {
        return $this->belongsTo(PatologiaEspecifica::class, 'id_pat_especifica', 'id');
    }

    public function centroAsistencial()
    {
        return $this->belongsTo(CentroAsistencial::class, 'id_cent_asist', 'id');
    }

    public function validacion()
    {
        return $this->belongsTo(User::class, 'id_validacion', 'id');
    }

    public function anulacion()
    {
        return $this->belongsTo(User::class, 'id_anulacion', 'id');
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'id_create', 'id');
    }
    
}
