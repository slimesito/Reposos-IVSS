<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProrrogasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prorrogas', function (Blueprint $table) {
            $table->id();
            $table->char('numero_ref_prorroga', 25)->nullable();
            $table->unsignedBigInteger('id_expediente', 19);
            $table->bigInteger('cedula');
            $table->unsignedBigInteger('id_cent_asist', 19);
            $table->unsignedBigInteger('id_servicio', 19);
            $table->unsignedBigInteger('id_capitulo', 19);
            $table->unsignedBigInteger('id_pat_general', 19);
            $table->unsignedBigInteger('id_pat_especifica', 19)->nullable();
            $table->string('evolucion', 250)->nullable();
            $table->string('estatus');
            $table->string('observaciones', 250)->nullable();
            $table->unsignedBigInteger('id_create', 19);
            $table->date('fecha_create');
            $table->unsignedBigInteger('id_update', 19)->nullable();
            $table->date('fecha_update')->nullable();

            $table->foreign('cedula')->references('cedula')->on('expedientes');
            $table->foreign('id_cent_asist')->references('id')->on('centros_asistenciales');
            $table->foreign('id_servicio')->references('id')->on('servicios');
            $table->foreign('id_capitulo')->references('id')->on('capitulos');
            $table->foreign('id_pat_general')->references('id')->on('patologias_generales');
            $table->foreign('id_pat_especifica')->references('id')->on('patologias_especificas');
            $table->foreign('id_create')->references('id')->on('users');
            $table->foreign('id_update')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prorrogas');
    }
};
