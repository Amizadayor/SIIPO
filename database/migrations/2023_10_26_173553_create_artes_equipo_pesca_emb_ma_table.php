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
        Schema::create('artes_equipo_pesca_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('TPArtPescaid');
            $table->unsignedBigInteger('TPEspecieid');
            $table->integer('Cantidad');
            $table->decimal('Longitud', 10, 2)->default(0.00);
            $table->decimal('Altura', 10, 2)->default(0.00);
            $table->decimal('Malla', 10, 2)->default(0.00);
            $table->string('Material', 50)->default('0.00');
            $table->decimal('Reinales', 10, 2)->default(0.00);
            $table->unsignedBigInteger('DGEMMAid');

            $table->foreign('TPArtPescaid')->references('id')->on('artes_pesca');
            $table->foreign('TPEspecieid')->references('id')->on('especies');
            $table->foreign('DGEMMAid')->references('id')->on('datosgenerales_emb_ma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artes_equipo_pesca_emb_ma');
    }
};
