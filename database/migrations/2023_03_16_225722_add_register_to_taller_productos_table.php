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
        Schema::table('taller_productos', function (Blueprint $table) {
            $table->integer('id_product_woo')->nullable();
            $table->integer('price')->nullable();
            $table->string('sku')->nullable();
            $table->string('permalink')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taller_productos', function (Blueprint $table) {
            //
        });
    }
};
