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
        Schema::create('equipos_salvamento_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('EqpoSalvamentoid');
            $table->unsignedBigInteger('DGEMMAid');

            $table->foreign('EqpoSalvamentoid')->references('id')->on('equipos_salvamento');
            $table->foreign('DGEMMAid')->references('id')->on('datosgenerales_emb_ma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos_salvamento_emb_ma');
    }
};
