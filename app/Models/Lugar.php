<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    use HasFactory;

    protected $connection = 'oracle';
    protected $table = 're_reposo_lugar';
    protected $primaryKey = 'cod_lugar';
    protected $fillable = [
        'cod_lugar_desc',
        'descripcion',
        'activo',
        'cod_usuario_crea',
        'fecha_crea',
        'cod_usuario_modifica',
        'fecha_modifica',
    ];
}
