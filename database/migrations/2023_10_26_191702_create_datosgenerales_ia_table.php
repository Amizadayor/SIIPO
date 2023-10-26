<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('datosgenerales_ia', function (Blueprint $table) {
            $table->id();
            $table->string('NombreInstalacion', 50)->nullable();
            $table->string('RNPA', 50)->nullable();
            $table->string('Ubicacion', 100)->nullable();
            $table->text('Acceso');
            $table->binary('DocActaCreacion')->nullable();
            $table->binary('DocPlanoInstalaciones')->nullable();
            $table->binary('DocAcreditacionLegalInstalacion')->nullable();
            $table->binary('DocComprobanteDomicilio')->nullable();
            $table->binary('DocEspeTecnicasFisicas')->nullable();
            $table->binary('DocMapaLocalizacion')->nullable();
            $table->unsignedBigInteger('Locid');
            $table->unsignedBigInteger('UEIAid')->nullable();

            $table->foreign('Locid')->references('id')->on('localidades');
            $table->foreign('UEIAid')->references('id')->on('unidadeconomica_ia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('datosgenerales_ia');
    }
};
