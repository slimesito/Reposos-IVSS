<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;

    protected $connection = 'oracle';
    protected $table = 'capitulos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'capitulo_id',
        'descripcion',
        'activo',
        'id_create',
        'fecha_create',
        'id_update',
        'fecha_update',
    ];
    
    public $timestamps = false;

    public function creador()
    {
        return $this->belongsTo(User::class, 'id_create', 'id');
    }

    public function modificador()
    {
        return $this->belongsTo(User::class, 'id_update', 'id');
    }
}
