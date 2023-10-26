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
        Schema::create('datosgenerales_ia', function (Blueprint $table) {
            $table->id();
            $table->string('NombreInstalacion', 50);
            $table->string('RNPA', 50)->nullable();
            $table->string('Ubicacion', 100);
            $table->text('Acceso');
            $table->binary('DocActaCreacion');
            $table->binary('DocPlanoInstalaciones');
            $table->binary('DocAcreditacionLegalInstalacion');
            $table->binary('DocComprobanteDomicilio');
            $table->binary('DocEspeTecnicasFisicas');
            $table->binary('DocMapaLocalizacion');
            $table->unsignedBigInteger('Locid');
            $table->unsignedBigInteger('UEIAid')->nullable();

            $table->foreign('Locid')->references('id')->on('localidades');
            $table->foreign('UEIAid')->references('id')->on('unidadeconomica_ia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datosgenerales_ia');
    }
};
