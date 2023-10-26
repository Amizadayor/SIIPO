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
        Schema::create('sistemas_conservacion_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('SisConservacionid');
            $table->unsignedBigInteger('DGEMMAid');

            $table->foreign('SisConservacionid')->references('id')->on('sistemas_conservacion');
            $table->foreign('DGEMMAid')->references('id')->on('datosgenerales_emb_ma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sistemas_conservacion_emb_ma');
    }
};
