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
        Schema::create('historial_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_producto')->nullable();
            $table->string('accion')->nullable();
            $table->string('cantidad')->nullable();
            
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_productos');
    }
};
