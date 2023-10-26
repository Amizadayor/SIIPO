<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('docs_regtr_artespesca_emb_me', function (Blueprint $table) {
            $table->id();
            $table->binary('DocFacturaElectronica')->nullable();
            $table->binary('DocNotaRemision')->nullable();
            $table->binary('DocFacturaEndosada')->nullable();
            $table->binary('DocTestimonial')->nullable();
            $table->unsignedBigInteger('ArteEquipoPescaEmbMeid');

            $table->foreign('ArteEquipoPescaEmbMeid')->references('id')->on('artes_equipo_pesca_emb_me');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('docs_regtr_artespesca_emb_me');
    }
};
