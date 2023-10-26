<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artes_equipo_pesca_por_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ArteEquipoPescaEmbMaid');
            $table->unsignedBigInteger('DGEMMAid');

            $table->foreign('DGEMMAid')->references('id')->on('datosgenerales_emb_ma');
            $table->foreign('ArteEquipoPescaEmbMaid')->references('id')->on('artes_equipo_pesca_emb_ma');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artes_equipo_pesca_por_emb_ma');
    }
};
