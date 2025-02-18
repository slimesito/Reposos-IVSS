<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $connection = 'oracle';

    protected $table = 'servicios';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'cod_servicio',
        'nombre',
        'tiempo_cita',
        'autoriza_maternidad',
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
