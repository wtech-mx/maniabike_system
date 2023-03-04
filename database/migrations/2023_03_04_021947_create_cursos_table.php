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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('foto', 900)->nullable();
            $table->date('fecha_inicial');
            $table->string('hora_inicial');
            $table->date('fecha_final');
            $table->string('hora_final');
            $table->string('categoria')->nullable();
            $table->string('modalidad');
            $table->text('id_lugar')->nullable();
            $table->string('objetivo')->nullable();
            $table->text('temario');
            $table->string('sep')->nullable();
            $table->string('unam')->nullable();
            $table->string('stps')->nullable();
            $table->string('redconocer')->nullable();
            $table->string('imnas')->nullable();
            $table->string('recurso')->nullable();
            $table->string('informacion')->nullable();
            $table->string('clase_grabada', 9000)->nullable();
            $table->string('destacado')->nullable();
            $table->string('estatus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
