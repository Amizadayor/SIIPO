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
        Schema::create('fuentes_agua_ia', function (Blueprint $table) {
            $table->id();
            $table->boolean('FTPozoProfundo');
            $table->boolean('FTPozoCieloAbierto');
            $table->boolean('FTRio');
            $table->boolean('FTLago');
            $table->boolean('FTArroyo');
            $table->boolean('FTPresa');
            $table->boolean('FTMar');
            $table->text('FTOtro')->nullable();
            $table->decimal('FlujoAguaLxM', 10, 2)->default(0.00);
            $table->unsignedBigInteger('DGIAid');

            $table->foreign('DGIAid')->references('id')->on('datosgenerales_ia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuentes_agua_ia');
    }
};
