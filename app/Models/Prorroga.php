<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prorroga extends Model
{
    use HasFactory;

    protected $connection = 'oracle';
    protected $table = 'prorrogas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'numero_ref_prorroga',
        'id_expediente',
        'cedula',
        'id_cent_asist',
        'id_servicio',
        'id_capitulo',
        'id_pat_general',
        'id_pat_especifica',
        'evolucion',
        'estatus',
        'observaciones',
        'id_create',
        'fecha_create',
        'id_update',
        'fecha_update',
        'inicio_prorroga',
        'fin_prorroga',
        'telefono'
    ];

    // Relaciones

    public function expediente()
    {
        return $this->belongsTo(Expediente::class, 'id_expediente', 'id');
    }

    public function cedula()
    {
        return $this->belongsTo(Expediente::class, 'cedula', 'cedula');
    }

    public function centroAsistencial()
    {
        return $this->belongsTo(CentroAsistencial::class, 'id_cent_asist', 'id');
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

    public function creador()
    {
        return $this->belongsTo(User::class, 'id_create', 'id');
    }

    public function actualizador()
    {
        return $this->belongsTo(User::class, 'id_update', 'id');
    }
}
