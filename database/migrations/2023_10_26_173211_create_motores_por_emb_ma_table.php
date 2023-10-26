<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motores_por_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('DGEMMAid');
            $table->unsignedBigInteger('MtrEmbMaid');

            $table->foreign('DGEMMAid')->references('id')->on('datosgenerales_emb_ma');
            $table->foreign('MtrEmbMaid')->references('id')->on('motores_emb_ma');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motores_por_emb_ma');
    }
};
