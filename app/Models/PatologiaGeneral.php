<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatologiaGeneral extends Model
{
    use HasFactory;

    protected $connection = 'oracle';

    protected $table = 'patologias_generales';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'pat_general_id',
        'capitulo_id',
        'descripcion',
        'dias_reposo',
        'activo',
        'id_create',
        'fecha_create',
        'id_update',
        'fecha_update',
    ];

    public function capitulo()
    {
        return $this->belongsTo(Capitulo::class, 'capitulo_id', 'id');
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
