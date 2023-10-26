<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permisos_pesca_pa', function (Blueprint $table) {
            $table->id();
            $table->string('FolioPermiso', 50);
            $table->date('FechaExpedicion');
            $table->date('FechaVigencia');
            $table->boolean('EstatusPermiso');
            $table->text('Nota');
            $table->unsignedBigInteger('TPPescaid');
            $table->unsignedBigInteger('DetallePAid');
            $table->unsignedBigInteger('DGPAid');

            $table->foreign('TPPescaid')->references('id')->on('permisos_pesca');
            $table->foreign('DetallePAid')->references('id')->on('detalles_pa');
            $table->foreign('DGPAid')->references('id')->on('datosgenerales_pa');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permisos_pesca_pa');
    }
};
