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
        Schema::create('taller_productos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_taller');
            $table->foreign('id_taller')
                ->references('id')->on('taller')
                ->inDelete('set null');

            $table->string('producto')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taller_productos');
    }
};
