<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('caractrsgen_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->integer('CdPatrones');
            $table->integer('CdMotoristas');
            $table->integer('CdPSEspecializados');
            $table->integer('CdPescadores');
            $table->integer('AnioConstruccion');
            $table->unsignedBigInteger('TPActid');
            $table->unsignedBigInteger('TPCubid');
            $table->unsignedBigInteger('MtrlCascoid');
            $table->unsignedBigInteger('DGEMMAid');

            $table->foreign('TPActid')->references('id')->on('tipos_actividad');
            $table->foreign('TPCubid')->references('id')->on('tipos_cubierta');
            $table->foreign('MtrlCascoid')->references('id')->on('materiales_casco');
            $table->foreign('DGEMMAid')->references('id')->on('datosgenerales_emb_ma');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caractrsgen_emb_ma');
    }
};
