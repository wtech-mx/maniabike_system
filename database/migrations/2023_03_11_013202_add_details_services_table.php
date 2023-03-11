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
        Schema::table('taller', function (Blueprint $table) {
            $table->string('color_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taller', function (Blueprint $table) {
            $table->dropColumn('sprock');
            $table->dropColumn('multiplicacion');
        });
    }
};
