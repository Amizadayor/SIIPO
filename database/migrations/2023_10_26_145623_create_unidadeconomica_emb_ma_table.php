<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unidadeconomica_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->string('RNPA', 50)->nullable();
            $table->string('Nombre', 50);
            $table->boolean('ActivoPropio');
            $table->unsignedBigInteger('UEDuenoid');

            $table->foreign('UEDuenoid')->references('id')->on('unidadeconomica_pa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('unidadeconomica_emb_ma');
    }
};
