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
        Schema::create('datosgenerales_emb_ma', function (Blueprint $table) {
            $table->id();
            $table->string('NombreEmbMayor', 50);
            $table->string('RNPA', 50)->nullable();
            $table->string('Matricula', 50);
            $table->string('PuertoBase', 50);
            $table->binary('DocAcreditacionLegalMotor');
            $table->binary('DocCertificadoMatricula');
            $table->binary('DocComprobanteTenenciaLegal');
            $table->binary('DocCertificadoSegEmbs');
            $table->unsignedBigInteger('UEEMMAid')->nullable();

            $table->foreign('UEEMMAid')->references('id')->on('unidadeconomica_emb_ma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datosgenerales_emb_ma');
    }
};
