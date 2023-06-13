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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->string('fecha');
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')
                ->references('id')->on('products')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')
                ->references('id')->on('clientes')
                ->inDelete('set null');

            $table->string('metodo_pago');
            $table->string('tipo');
            $table->string('descuento');
            $table->string('subtotal');
            $table->string('total');
            $table->string('comentario');
            $table->string('comprobante');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
