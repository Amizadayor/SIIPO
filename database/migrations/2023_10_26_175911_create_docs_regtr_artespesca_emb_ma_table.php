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
        Schema::create('docs_regtr_artespesca_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->binary('DocFacturaElectronica');
            $table->binary('DocNotaRemision');
            $table->binary('DocFacturaEndosada');
            $table->binary('DocTestimonial');
            $table->unsignedBigInteger('ArteEquipoPescaEmbMaID');

            $table->foreign('ArteEquipoPescaEmbMaID')->references('id')->on('artes_equipo_pesca_emb_ma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docs_regtr_artespesca_emb_ma');
    }
};
