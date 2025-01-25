<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 255);
            $table->string('apellidos', 255);
            $table->string('cedula', 10)->unique();
            $table->string('email')->unique();
            $table->string('password', 255);
            $table->integer('nro_mpps')->unique();
            $table->integer('cod_cargo', 5);
            $table->string('telefono', 20)->unique();
            $table->string('telefono_oficina', 20);
            $table->unsignedBigInteger('id_servicio')->nullable();
            $table->unsignedBigInteger('id_centro_asistencial')->nullable();
            $table->string('foto')->nullable();
            $table->string('sello')->nullable();
            $table->string('firma')->nullable();
            $table->boolean('activo');
            $table->string('pregunta_secreta1', 50)->nullable();
            $table->string('respuesta_secreta1', 50)->nullable();
            $table->string('pregunta_secreta2', 50)->nullable();
            $table->string('respuesta_secreta2', 50)->nullable();
            $table->string('pregunta_secreta3', 50)->nullable();
            $table->string('respuesta_secreta3', 50)->nullable();
            $table->unsignedBigInteger('id_create');
            $table->date('fecha_create');
            $table->unsignedBigInteger('id_update')->nullable();
            $table->date('fecha_update')->nullable();
            $table->date('ultimo_inicio_sesion')->nullable();

            $table->foreign('cod_cargo')->references('COD_CARGO')->on('CF_CARGO');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
