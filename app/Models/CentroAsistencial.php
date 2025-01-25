<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentroAsistencial extends Model
{
    use HasFactory;

    protected $connection = 'oracle';

    protected $table = 'centros_asistenciales';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'cod_centro',
        'nombre',
        'cod_estado',
        'es_hospital',
        'cod_tipo',
        'nro_reposo_1473',
        'rango_ip',
        'activo',
        'id_create',
        'fecha_create',
        'id_update',
        'fecha_update',
    ];

    // Relación con el modelo User
    public function creador()
    {
        return $this->belongsTo(User::class, 'id_create', 'id');
    }

    public function modificador()
    {
        return $this->belongsTo(User::class, 'id_update', 'id');
    }
}
