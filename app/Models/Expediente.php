<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $connection = 'oracle';
    protected $table = 'expedientes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'cedula',
        'cantidad_reposos',
        'cantidad_prorrogas',
        'dias_acumulados',
        'semanas_acumuladas',
        'dias_pendientes',
        'id_ultimo_cent_asist',
        'id_ultimo_reposo',
        'es_abierto',
        'id_create',
        'fecha_create',
        'id_update',
        'fecha_update',
        'id_ultima_prorroga',
    ];

    // Relaciones

    public function ultimoCentroAsistencial()
    {
        return $this->belongsTo(CentroAsistencial::class, 'id_ultimo_cent_asist', 'id');
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'id_create', 'id');
    }

    public function modificador()
    {
        return $this->belongsTo(User::class, 'id_update', 'id');
    }
}
