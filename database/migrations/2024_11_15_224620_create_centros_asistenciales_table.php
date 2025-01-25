<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentrosAsistencialesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('centros_asistenciales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cod_centro', 10)->unique();
            $table->string('nombre', 250)->unique();
            $table->unsignedBigInteger('cod_estado', 10);
            $table->boolean('es_hospital');
            $table->unsignedBigInteger('cod_tipo', 10);
            $table->unsignedBigInteger('nro_reposo_1473', 10);
            $table->string('rango_ip', 11)->nullable();
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
        Schema::dropIfExists('centros_asistenciales');
    }
};
