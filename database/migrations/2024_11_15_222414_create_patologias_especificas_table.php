<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatologiasEspecificasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patologias_especificas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('capitulo_id', 10);
            $table->unsignedBigInteger('id_pat_general', 10);
            $table->unsignedBigInteger('cod_pat_especifica', 10);
            $table->unsignedBigInteger('id_pat_especifica', 3);
            $table->string('descripcion', 250)->unique();
            $table->integer('dias_reposo');
            $table->boolean('activo');
            $table->unsignedBigInteger('id_create');
            $table->date('fecha_create');
            $table->unsignedBigInteger('id_update')->nullable();
            $table->date('fecha_update')->nullable();

            $table->foreign('capitulo_id')->references('id')->on('capitulos');
            $table->foreign('id_pat_general')->references('id')->on('patologias_generales');
            $table->foreign('id_create')->references('id')->on('users');
            $table->foreign('id_update')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patologias_especificas');
    }
};
