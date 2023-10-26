<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipos_contraincendio_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('EqpoContraIncendioid');
            $table->unsignedBigInteger('DGEMMAid');

            $table->foreign('EqpoContraIncendioid')->references('id')->on('equipos_contraincendio');
            $table->foreign('DGEMMAid')->references('id')->on('datosgenerales_emb_ma');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipos_contraincendio_emb_ma');
    }
};
