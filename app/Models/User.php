<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'cedula',
        'email',
        'password',
        'nro_mpps',
        'cod_cargo',
        'telefono',
        'telefono_oficina',
        'id_servicio',
        'id_centro_asistencial',
        'foto',
        'sello',
        'firma',
        'activo',
        'pregunta_secreta1',
        'respuesta_secreta1',
        'pregunta_secreta2',
        'respuesta_secreta2',
        'pregunta_secreta3',
        'respuesta_secreta3',
        'id_create',
        'fecha_create',
        'id_update',
        'fecha_update',
        'ultimo_inicio_sesion',
        
    ];

    // Definir la relación con CF_CARGO
    // public function cargo()
    // {
    //     return $this->belongsTo(CfCargo::class, 'cod_cargo', 'cod_cargo');
    // }

    // Definir la relación con CENTROS_ASISTENCIALES
    public function centroAsistencial()
    {
        return $this->belongsTo(CentroAsistencial::class, 'id_centro_asistencial', 'id');
    }

    // Definir la relación con SERVICIOS
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio', 'id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'respuesta_secreta1',
        'respuesta_secreta2',
        'respuesta_secreta3',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
