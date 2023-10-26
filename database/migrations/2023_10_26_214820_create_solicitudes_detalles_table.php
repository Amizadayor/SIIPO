<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitudes_detalles', function (Blueprint $table) {
            $table->id();
            $table->string('FolioSolicitud', 13);
            $table->date('FechaSolicitud');
            $table->unsignedBigInteger('TPProcesoid');
            $table->unsignedBigInteger('TPModalidadid');
            $table->unsignedBigInteger('TPSolicitudid');

            $table->foreign('TPProcesoid')->references('id')->on('tipos_proceso');
            $table->foreign('TPModalidadid')->references('id')->on('tipos_modalidad');
            $table->foreign('TPSolicitudid')->references('id')->on('tipos_solicitud');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitudes_detalles');
    }
};
