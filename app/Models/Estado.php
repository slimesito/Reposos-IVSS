<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $connection = 'oracle';
    protected $table = 'estados';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'cod_region',
        'activo',
        'id_create',
        'fecha_create',
        'id_update',
        'fecha_update'
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

    // Relación con el modelo CentroAsistencial
    public function centrosAsistenciales()
    {
        return $this->hasMany(CentroAsistencial::class, 'cod_estado', 'id');
    }
}
