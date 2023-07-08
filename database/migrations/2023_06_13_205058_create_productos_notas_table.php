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
        Schema::create('productos_notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_product');
            $table->foreign('id_product')
                ->references('id')->on('products')
                ->inDelete('set null');

            $table->string('id_product_woo')->nullable();

            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('notas')
                ->inDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_notas');
    }
};
