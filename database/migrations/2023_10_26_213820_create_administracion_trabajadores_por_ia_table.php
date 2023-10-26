<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('administracion_trabajadores_por_ia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ATIAid');
            $table->unsignedBigInteger('DGIAid');

            $table->foreign('ATIAid')->references('id')->on('administracion_trabajadores_ia');
            $table->foreign('DGIAid')->references('id')->on('datosgenerales_ia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('administracion_trabajadores_por_ia');
    }
};
