<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivo extends Model
{
    use HasFactory;

    protected $connection = 'oracle';
    protected $table = 're_reposo_motivo';
    protected $primaryKey = 'cod_motivo';
    protected $fillable = [
        'cod_motivo_desc',
        'descripcion',
        'activo',
        'cod_usuario_crea',
        'fecha_crea',
        'cod_usuario_modifica',
        'fecha_modifica',
    ];
}
