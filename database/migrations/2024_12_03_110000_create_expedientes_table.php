<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cod_trabajador')->unique();
            $table->integer('cantidad_reposos', 5);
            $table->integer('cantidad_prorrogas', 5);
            $table->integer('dias_acumulados', 5);
            $table->decimal('semanas_acumuladas', 5, 2);
            $table->bigInteger('dias_pendientes');
            $table->unsignedBigInteger('id_ultimo_cent_asist');
            $table->unsignedBigInteger('id_ultimo_reposo');
            $table->boolean('es_abierto');
            $table->unsignedBigInteger('id_create');
            $table->date('fecha_create');
            $table->unsignedBigInteger('id_update')->nullable();
            $table->date('fecha_update')->nullable();

            $table->foreign('cod_trabajador')->references('cod_trabajador')->on('re_trabajador');
            $table->foreign('id_ultimo_cent_asist')->references('id')->on('centros_asistenciales');
            $table->foreign('id_ultimo_reposo')->references('id')->on('reposos');
            $table->foreign('id_create')->references('id')->on('users');
            $table->foreign('id_update')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};
