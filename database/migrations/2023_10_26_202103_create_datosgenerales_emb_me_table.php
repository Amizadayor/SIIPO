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
        Schema::create('datosgenerales_emb_me', function (Blueprint $table) {
            $table->id();
            $table->string('NombreEmbarcacion', 100)->nullable();
            $table->string('RNPA', 50)->nullable();
            $table->string('Matricula', 50);
            $table->decimal('CapacidadCarga', 10, 2)->default(0.00);
            $table->decimal('MedidaEslora', 10, 2)->default(0.00);
            $table->binary('DocAcreditacionLegalMotor')->nullable();
            $table->binary('DocCertificadoMatricula')->nullable();
            $table->binary('DocComprobanteTenenciaLegal')->nullable();
            $table->binary('DocCertSeguridadEmbarcaciones')->nullable();
            $table->unsignedBigInteger('UEEMMEid')->nullable();
            $table->unsignedBigInteger('TPActid');
            $table->unsignedBigInteger('MtrlCascoid');

            $table->foreign('UEEMMEid')->references('id')->on('unidadeconomica_emb_me');
            $table->foreign('TPActid')->references('id')->on('tipos_actividad');
            $table->foreign('MtrlCascoid')->references('id')->on('materiales_casco');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datosgenerales_emb_me');
    }
};
