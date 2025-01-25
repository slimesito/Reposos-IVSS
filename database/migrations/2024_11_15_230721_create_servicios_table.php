<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_servicio', 10)->unique();
            $table->string('nombre', 50)->unique();
            $table->integer('tiempo_cita', 10);
            $table->boolean('autoriza_maternidad');
            $table->boolean('activo');
            $table->unsignedBigInteger('id_create');
            $table->date('fecha_create');
            $table->unsignedBigInteger('id_update')->nullable();
            $table->date('fecha_update')->nullable();

            $table->foreign('id_create')->references('id')->on('users');
            $table->foreign('id_update')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
