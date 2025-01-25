<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepososTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reposos', function (Blueprint $table) {
            $table->id();
            $table->char('numero_ref_reposo', 25)->nullable();
            $table->unsignedBigInteger('id_expediente');
            $table->bigInteger('cod_trabajador');
            $table->decimal('indice', 18, 2)->nullable();
            $table->char('nro_empleador', 10)->nullable();
            $table->unsignedBigInteger('id_servicio');
            $table->unsignedBigInteger('id_capitulo');
            $table->unsignedBigInteger('id_pat_general');
            $table->unsignedBigInteger('id_pat_especifica')->nullable();
            $table->unsignedBigInteger('id_lugar');
            $table->smallInteger('cod_motivo');
            $table->date('inicio_reposo');
            $table->date('fin_reposo');
            $table->date('reintegro');
            $table->boolean('debe_volver');
            $table->boolean('convalidado');
            $table->boolean('es_enfermedad');
            $table->boolean('es_prenatal');
            $table->boolean('es_postnatal');
            $table->bigInteger('cod_estatus');
            $table->bigInteger('id_validacion')->nullable();
            $table->date('fecha_validacion')->nullable();
            $table->bigInteger('cod_tipo_anulacion')->nullable();
            $table->string('observacion_anulacion', 250)->nullable();
            $table->bigInteger('id_anulacion')->nullable();
            $table->date('fecha_anulacion')->nullable();
            $table->string('observaciones', 250)->nullable();
            $table->string('tipo_pago', 10)->nullable();
            $table->decimal('total_reposo', 18, 2)->nullable();
            $table->char('atencion', 1)->nullable();
            $table->bigInteger('dias_indemnizar')->nullable();
            $table->unsignedBigInteger('id_create');
            $table->date('fecha_create');

            $table->foreign('cod_trabajador')->references('cod_trabajador')->on('re_trabajador');
            $table->foreign('id_servicio')->references('id')->on('servicios');
            $table->foreign('id_capitulo')->references('id')->on('capitulos');
            $table->foreign('id_pat_general')->references('id')->on('patologias_generales');
            $table->foreign('id_pat_especifica')->references('id')->on('patologias_especificas');
            $table->foreign('cod_estatus')->references('cod_estatus')->on('re_estatus_reposo');
            $table->foreign('id_validacion')->references('id')->on('users');
            $table->foreign('id_anulacion')->references('id')->on('users');
            $table->foreign('id_create')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reposos');
    }
};
