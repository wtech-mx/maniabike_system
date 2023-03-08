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
        Schema::create('taller', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')
                ->references('id')->on('clientes')
                ->inDelete('set null');

            $table->date('fecha')->nullable();
            $table->string('estatus')->nullable();

            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('rodada')->nullable();
            $table->string('tipo')->nullable();
            $table->string('color');
            $table->string('foto1', 900)->nullable();
            $table->string('foto2', 900)->nullable();
            $table->string('foto3', 900)->nullable();
            $table->string('foto4', 900)->nullable();
            $table->string('cadena')->nullable();
            $table->string('sprock')->nullable();
            $table->string('multiplicacion')->nullable();
            $table->string('otro')->nullable();
            $table->string('llanta_d')->nullable();
            $table->string('llanta_t')->nullable();
            $table->string('frenos_d')->nullable();
            $table->string('frenos_t')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('eje')->nullable();
            $table->string('camaras')->nullable();
            $table->string('mandos')->nullable();
            $table->string('total')->nullable();
            $table->string('resto')->nullable();
            $table->string('metodo_pago')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taller');
    }
};
