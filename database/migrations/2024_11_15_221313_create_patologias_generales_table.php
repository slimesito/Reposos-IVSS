<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatologiasGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patologias_generales', function (Blueprint $table) {
            $table->id();
            $table->string('pat_general_id', 10)->unique();
            $table->unsignedBigInteger('capitulo_id');
            $table->string('descripcion', 250)->unique();
            $table->integer('dias_reposo');
            $table->boolean('activo');
            $table->unsignedBigInteger('id_create');
            $table->date('fecha_create');
            $table->unsignedBigInteger('id_update')->nullable();
            $table->date('fecha_update')->nullable();

            // Claves foráneas
            $table->foreign('capitulo_id')->references('id')->on('capitulos');
            $table->foreign('id_create')->references('id')->on('users');
            $table->foreign('id_update')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patologias_generales');
    }
};
