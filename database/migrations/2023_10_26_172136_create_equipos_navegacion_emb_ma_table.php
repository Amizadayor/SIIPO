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
        Schema::create('equipos_navegacion_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('EqpoNavegacionid');
            $table->unsignedBigInteger('DGEMMAid');

            $table->foreign('EqpoNavegacionid')->references('id')->on('equipos_navegacion');
            $table->foreign('DGEMMAid')->references('id')->on('datosgenerales_emb_ma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos_navegacion_emb_ma');
    }
};
