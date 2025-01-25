<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatologiaEspecifica extends Model
{
    use HasFactory;

    protected $connection = 'oracle';

    protected $table = 'patologias_especificas';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'capitulo_id',
        'id_pat_general',
        'cod_pat_especifica',
        'id_pat_especifica',
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

    public function patologiaGeneral()
    {
        return $this->belongsTo(PatologiaGeneral::class, 'id_pat_general', 'id');
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
