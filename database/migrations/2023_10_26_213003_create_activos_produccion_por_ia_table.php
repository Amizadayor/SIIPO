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
        Schema::create('activos_produccion_por_ia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('DGIAid');
            $table->unsignedBigInteger('APIAid');

            $table->foreign('DGIAid')->references('id')->on('datosgenerales_ia');
            $table->foreign('APIAid')->references('id')->on('activos_produccion_ia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activos_produccion_por_ia');
    }
};
